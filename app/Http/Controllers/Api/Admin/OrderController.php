<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'books')->get();

        if ($orders) {
            $data = OrderResource::collection($orders);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function edit($order)
    {
        $order = Order::whereId($order)->with('user')->first();

        if ($order) {
            $data['order'] = new OrderResource($order);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function update(Request $request, $order)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'issue' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except(['_token', 'checkout', 'date_returned', 'user_id']);

        $order = Order::whereId($order)->with('user')->first();

        if (!$order) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($order->update($params)) {

            $book = Book::find($order->books->first()->id);

            if (!$book) {
                return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
            }

            if ($request->status == 'checkout') {
                $book->update([
                    'quantity' => $book->quantity - 1
                ]);
            } elseif ($request->status == 'returned') {
                $book->update([
                    'quantity' => $book->quantity + 1
                ]);
            }

            return response()->json(['data' => null, 'error' => 0, 'message' => 'Order updated successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function destroy($order)
    {
        $order = Order::whereId($order)->with('user')->first();

        if (!$order) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        $order->books()->detach();

        if ($order->delete()) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Order deleted successfully'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }
}
