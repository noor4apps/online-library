<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $checkout = null;
            $returned = null;
            $date_time_this_month = $faker->dateTimeThisMonth(now()->addYear());

            $status = $faker->randomElement(['submitting', 'checkout', 'returned']);

            if ($status == 'checkout') {
                $checkout = $date_time_this_month;
            } elseif ($status == 'returned') {
                $checkout = $date_time_this_month;
                $returned = Carbon::parse($date_time_this_month)->addDays(rand(1, 7));
            }
            $order = Order::create([
                'status' => $status,
                'checkout' => $checkout,
                'date_returned' => $returned,
                'created_at' => $date_time_this_month,
                'user_id' => User::inRandomOrder()->first()->id
            ]);
            $order->books()->attach(Book::inRandomOrder()->first()->id);
        }
    }
}
