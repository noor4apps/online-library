<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ShelfResource;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShelfController extends Controller
{
    public function index()
    {
        $shelves = Shelf::With('category:id,name')->get();

        if ($shelves) {
            $data = ShelfResource::collection($shelves);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();

        if ($categories) {
            $data['categories'] = CategoryResource::collection($categories);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'something went wrong!'], 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:shelves',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except('_token');

        $shelve = Shelf::create($params);

        if ($shelve) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Shelf added successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function edit($shelf)
    {
        $shelf = Shelf::with('category:id,name')->whereId($shelf)->first();
        $categories = Category::select('id', 'name')->get();

        if ($shelf and $categories) {
            $data['shelf'] = new ShelfResource($shelf);
            $data['categories'] = CategoryResource::collection($categories);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function update(Request $request, $shelf)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:shelves,name,' . $shelf,
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except('_token');

        $shelf = Shelf::whereId($shelf)->first();

        if (!$shelf) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($shelf->update($params)) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Shelf updated successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function destroy($shelf)
    {
        $shelf = Shelf::whereId($shelf)->first();

        if (!$shelf) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($shelf->delete()) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Shelf deleted successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }
}
