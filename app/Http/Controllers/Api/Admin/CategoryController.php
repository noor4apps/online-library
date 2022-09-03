<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->get();

        if ($categories) {
            $data = CategoryResource::collection($categories)->response()->getData(true);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        } else {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'something went wrong!'], 201);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except('_token');

        $category = Category::create($params);

        if ($category) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Category added successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Error occurred while creating category.'], 201);
    }

    public function edit($category)
    {
        $category = Category::whereId($category)->first();

        if ($category) {
            $data['category'] = new CategoryResource($category);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }
        return response()->json(['data' => null, 'error' => 1, 'message' => 'something went wrong!'], 201);
    }

    public function update(Request $request, $category)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:categories,name,' . $category,
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except('_token');

        $category = Category::whereId($category)->first();

        if (!$category) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($category->update($params)) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Category updated successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function destroy($category)
    {
        $category = Category::whereId($category)->first();

        if (!$category) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($category->delete()) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Category deleted successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }
}
