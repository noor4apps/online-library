<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::select('id', 'name')->get();

        if ($authors) {
            $data = AuthorResource::collection($authors);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'something went wrong!'], 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:authors',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except('_token');

        $author = Author::create($params);

        if ($author) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Author added successfully'], 200);
        }

        return response()->json(['data' => null, 'error' => 0, 'message' => 'Something went wrong!'], 201);
    }

    public function edit($author)
    {
        $author = Author::whereId($author)->first();

        if ($author) {
            $data['author'] = new  AuthorResource($author);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function update(Request $request, $author)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:authors,name,' . $author,
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except('_token');

        $author = Author::whereId($author)->first();

        if (!$author) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($author->update($params)) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Author updated successfully'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function destroy($author)
    {
        $author = Author::whereId($author)->first();

        if (!$author) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($author->delete()) {
            return response()->json(['data' => '', 'error' => 0, 'message' => 'Author deleted successfully'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }
}
