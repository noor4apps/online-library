<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\OrderResource;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->oredrs()->with('books:title')->get();

        if ($orders) {
            $data = OrderResource::collection($orders);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function store($book)
    {
        $status_order = auth()->user()->oredrs()->orderByDesc('created_at')->first();

        if ($status_order) {
            if ($status_order->status == 'submitting') {
                return response()->json(['data' => null, 'error' => 0, 'message' => 'The order was submitted.'], 200);
            } elseif ($status_order->status == 'checkout') {
                return response()->json(['data' => null, 'error' => 0, 'message' => 'The order status is checkout.'], 200);
            }
        }

        $book = Book::whereId($book)->first();

        if (!$book) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if($book->quantity == 0) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'The book is not available now!'], 200);
        }

        $data['user_id'] = auth()->id();

        $order = Order::create($data);

        if ($order) {
            $order->books()->attach($book->id);
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Order added successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function destroy($order)
    {
        $order = auth()->user()->oredrs()->whereId($order)->first();

        if (!$order) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($order->status == 'checkout') {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'The order status is checkout.'], 200);
        } elseif ($order->status == 'returned') {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'The order status is returned.'], 200);
        }

        $order->books()->detach();

        if ($order->delete()) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Order deleted successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }
}
