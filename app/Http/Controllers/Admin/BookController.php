<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class BookController extends Controller
{
    use UploadAble;

    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();
        return view('admin.books.create', compact('publishers', 'authors', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'isbn' => 'required',
            'quantity' => 'nullable',
            'edition' => 'required',
            'volume' => 'nullable',
            'issue' => 'nullable',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,bmp,svg,webp',
            'is_pdf' => 'nullable',
            'url' => 'required_if:is_pdf,true',
            'publisher_id' => 'required',
            'authors' => 'required',
            'categories' => 'required',
        ]);

        $params = $request->except(['_token', 'cover']);

        if ($request->has('cover') && ($request->file('cover') instanceof UploadedFile)) {
            $cover = $this->uploadOne($request->file('cover'), 'books');
            $params['cover'] = $cover;
        }

        $book = Book::create($params);

        if($request->authors) {
            $book->authors()->sync($request->authors);
        }

        if($request->categories) {
            $book->categories()->sync($request->categories);
        }

        if (!$book) {
            return redirect()->back()->with([
                'message' => 'Error occurred while creating book.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.books.index')->with([
            'message' => 'Book added successfully',
            'alert-type' => 'success'
        ]);

    }

    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('admin.books.edit', compact('book', 'publishers', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
//        dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'isbn' => 'required',
            'quantity' => 'nullable',
            'edition' => 'required',
            'volume' => 'nullable',
            'issue' => 'nullable',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,bmp,svg,webp',
            'is_pdf' => 'nullable',
            'url' => 'required_if:is_pdf,true',
            'publisher_id' => 'required',
            'authors' => 'required',
            'categories' => 'required',
        ]);

        $params = $request->except(['_token', 'cover']);

        if ($request->has('cover') && ($request->file('cover') instanceof UploadedFile)) {
            if ($book->cover != null) {
                $this->deleteOne($book->cover);
            }
            $cover = $this->uploadOne($request->file('cover'), 'books');
            $params['cover'] = $cover;
        }

        $book->update($params);

        if($request->authors) {
            $book->authors()->sync($request->authors);
        }

        if($request->categories) {
            $book->categories()->sync($request->categories);
        }

        if (!$book) {
            return redirect()->back()->with([
                'message' => 'Error occurred while updating book.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.books.index')->with([
            'message' => 'Book updated successfully',
            'alert-type' => 'success'
        ]);

    }

    public function destroy(Book $book)
    {
        if ($book->cover != null) {
            $this->deleteOne($book->cover);
        }

        $book = $book->delete();

        if (!$book) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting book.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.books.index')->with([
            'message' => 'Book deleted successfully',
            'alert-type' => 'success'
        ]);

    }

}
