<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookCategoriesTableSeeder extends Seeder
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
            $categories = Category::inRandomOrder()->take(3)->pluck('id')->toArray();
            $book->categories()->sync($categories);
        }
    }
}
