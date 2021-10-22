<?php

namespace App\Http\Controllers\Admin;

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

//        SELECT year(created_at) as year, month(created_at) as month, COUNT(id) as count_submitting FROM `book_users` GROUP BY month
        $orders_data = Order::select(
            DB::raw('year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw('COUNT(created_at) as count_submitting'))
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        return view('admin.dashboard.index', compact('users_count', 'books_count', 'orders_submitting', 'orders_checkout', 'orders_returned', 'orders_data'));
    }
}
