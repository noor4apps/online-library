<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PublisherResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    use UploadAble;

    public function index()
    {
        $books = Book::latest()->paginate(10);

        if ($books) {
            $data = BookResource::collection($books)->response()->getData(true);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function create()
    {
        if (!Cache::has('create_publishers')) {
            $publishers = Publisher::select('id', 'name')->get();
            Cache::remember('create_publishers', 3600, function () use ($publishers) {
                return $publishers;
            });
        }
        $publishers = Cache::get('create_publishers');

        if (!Cache::has('create_authors')) {
            $authors = Author::select('id', 'name')->get();
            Cache::remember('create_authors', 3600, function () use ($authors) {
                return $authors;
            });
        }
        $authors = Cache::get('create_authors');

        if (!Cache::has('create_categories')) {
            $categories = Category::select('id', 'name')->get();
            Cache::remember('create_categories', 3600, function () use ($categories) {
                return $categories;
            });
        }
        $categories = Cache::get('create_categories');

        if ($publishers and $authors and $categories) {
            $data['publishers'] = PublisherResource::collection($publishers);
            $data['authors'] = AuthorResource::collection($authors);
            $data['categories'] = CategoryResource::collection($categories);

            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'isbn' => 'required',
            'quantity' => 'nullable',
            'edition' => 'required',
            'volume' => 'nullable',
            'issue' => 'nullable',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,bmp,svg,webp',
            'is_pdf' => 'nullable|boolean',
            'url' => 'required_if:is_pdf,true,1',
            'publisher_id' => 'required',
            'authors.*' => 'required',
            'categories.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except(['_token', 'cover']);

        if ($request->has('cover') && ($request->file('cover') instanceof UploadedFile)) {
            $cover = $this->uploadOne($request->file('cover'), 'books');
            $params['cover'] = $cover;
        }

        $book = Book::create($params);

        if ($book) {

            $book->authors()->sync($request->authors);

            $book->categories()->sync($request->categories);

            return response()->json(['data' => null, 'error' => 0, 'message' => 'Book added successfully.'], 201);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 200);
    }

    public function show($book)
    {
        $book = Book::whereId($book)->first();

        if ($book) {
            $data = new BookResource($book);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function edit($book)
    {
        $book = Book::whereId($book)->first();

        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();

        if ($book and $publishers and $authors and $categories) {
            $data['book'] = new BookResource($book);

            $data['publishers'] = PublisherResource::collection($publishers);
            $data['authors'] = AuthorResource::collection($authors);
            $data['categories'] = CategoryResource::collection($categories);

            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function update(Request $request, $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'isbn' => 'required',
            'quantity' => 'nullable',
            'edition' => 'required',
            'volume' => 'nullable',
            'issue' => 'nullable',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,bmp,svg,webp',
            'is_pdf' => 'nullable|boolean',
            'url' => 'required_if:is_pdf,true,1',
            'publisher_id' => 'required',
            'authors.*' => 'required',
            'categories.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except(['_token', 'cover']);

        $book = Book::whereId($book)->first();

        if (!$book) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($request->has('cover') && ($request->file('cover') instanceof UploadedFile)) {
            if ($book->cover != null) {
                $this->deleteOne($book->cover);
            }
            $cover = $this->uploadOne($request->file('cover'), 'books');
            $params['cover'] = $cover;
        }

        if ($book->update($params)) {

            $book->authors()->sync($request->authors);

            $book->categories()->sync($request->categories);

            return response()->json(['data' => null, 'error' => 0, 'message' => 'Book updated successfully'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function destroy($book)
    {
        $book = Book::whereId($book)->first();

        if (!$book) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($book->cover != null) {
            $this->deleteOne($book->cover);
        }

        if ($book->delete()) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Book deleted successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

}
