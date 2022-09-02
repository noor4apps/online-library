<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $books = Book::take(5)->latest()->get();

        if ($books) {
            $data = BookResource::collection($books);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        } else {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'something went wrong!'], 201);
        }
    }

    public function grid()
    {
        $books = Book::latest()->paginate(6);

        if ($books) {
            $data = BookResource::collection($books)->response()->getData(true);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        } else {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'something went wrong!'], 201);
        }
    }

    public function show(Book $book)
    {
        if ($book) {
            $data =  new BookResource($book);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        } else {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'something went wrong!'], 201);
        }
    }

}
