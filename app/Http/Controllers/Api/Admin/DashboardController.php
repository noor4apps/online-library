<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::where('is_admin', 0)->count();
        $books_count = Book::count();
        $orders_submitting = Order::where('status', 'submitting')->count();
        $orders_checkout = Order::where('status', 'checkout')->count();
        $orders_returned = Order::where('status', 'returned')->count();

        $orders_data = Order::select(
            DB::raw('year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw('COUNT(created_at) as count_submitting'))
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();


        $data['users_count'] = $users_count;
        $data['books_count'] = $books_count;
        $data['orders_submitting'] = $orders_submitting;
        $data['orders_checkout'] = $orders_checkout;
        $data['orders_returned'] = $orders_returned;
        $data['orders_data'] = $orders_data;

        return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
    }
}
