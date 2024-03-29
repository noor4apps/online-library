<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with('books:title')->get();
        return view('site.orders.index', compact('orders'));
    }

    public function store(Book $book)
    {
        $status_order = Order::where('user_id', auth()->id())->orderByDesc('created_at')->first();

        if ($status_order) {
            if ($status_order->status == 'submitting') {
                return redirect()->back()->with([
                    'message' => 'The order was submitted.',
                    'alert-type' => 'info'
                ]);
            } elseif ($status_order->status == 'checkout') {
                return redirect()->back()->with([
                    'message' => 'The order status is checkout.',
                    'alert-type' => 'danger'
                ]);
            }
        }

        if($book->quantity == 0) {
            return redirect()->back()->with([
                'message' => 'The book is not available now',
                'alert-type' => 'danger'
            ]);
        }

        $data['user_id'] = auth()->id();

        $order = Order::create($data);
        $order->books()->attach($book->id);

        if (!$order) {
            return redirect()->back()->with([
                'message' => 'Error occurred while creating order.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Order added successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($order)
    {
        $order = Order::where('user_id', auth()->id())->findOrfail($order);

        if ($order) {
            if ($order->status == 'checkout') {
                return redirect()->back()->with([
                    'message' => 'The order status is checkout.',
                    'alert-type' => 'danger'
                ]);
            } elseif ($order->status == 'returned') {
                return redirect()->back()->with([
                    'message' => 'The order status is returned.',
                    'alert-type' => 'danger'
                ]);
            }
        }

        $order->books()->detach();

        $order_result = $order->delete();

        if (!$order_result) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting order.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('site.orders.index')->with([
            'message' => 'Order deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
