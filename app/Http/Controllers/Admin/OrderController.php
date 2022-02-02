<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
            'status' => 'required',
            'issue' => 'nullable'
        ]);

        $params = $request->except(['_token', 'checkout', 'date_returned', 'user_id']);

        $order_result = $order->update($params);

        $book = Book::find($order->books->first()->id);

        if ($request->status == 'checkout') {
            $book->update([
                'quantity' => $book->quantity - 1
            ]);
        } elseif ($request->status == 'returned') {
            $book->update([
                'quantity' => $book->quantity + 1
            ]);
        }

        if (!$order_result) {
            return redirect()->back()->with([
                'message' => 'Error occurred while ordering category.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.orders.index')->with([
            'message' => 'Order updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Order $order)
    {
        $order->books()->detach();

        $order = $order->delete();

        if (!$order) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting order.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.orders.index')->with([
            'message' => 'Order deleted successfully',
            'alert-type' => 'success'
        ]);

    }
}
