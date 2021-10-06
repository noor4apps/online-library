<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BookUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();
        foreach ($books as $book) {
            $users = User::inRandomOrder()->take(3)->pluck('id')->toArray();
            $book->users()->sync($users);
        }
    }
}
