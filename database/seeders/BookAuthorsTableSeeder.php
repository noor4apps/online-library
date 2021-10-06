<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookAuthorsTableSeeder extends Seeder
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
            $authors = Author::inRandomOrder()->take(3)->pluck('id')->toArray();
            $book->authors()->sync($authors);
        }
    }
}
