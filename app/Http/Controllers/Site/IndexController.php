<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $books = Book::take(5)->latest()->get();
        return view('site.index', compact('books'));
    }

    public function grid()
    {
        $books = Book::latest()->paginate(6);
        return view('site.grid', compact('books'));
    }

    public function show(Book $book)
    {
        return view('site.book', compact('book'));
    }
}
