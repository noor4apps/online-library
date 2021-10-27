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
        $orders = Order::where('user_id', auth()->id())->get();
        return view('site.orders.index', compact('orders'));
    }

    public function store(Book $book)
    {
        $status_book = Order::where('user_id', auth()->id())->where('book_id', $book->id)->orderByDesc('created_at')->first();
        if ($status_book) {
            if ($status_book->status == 'submitting') {
                return redirect()->back()->with([
                    'message' => 'The order was submitted.',
                    'alert-type' => 'info'
                ]);
            } elseif ($status_book->status == 'checkout') {
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
        $data['book_id'] = $book->id;

        $order = Order::create($data);

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
