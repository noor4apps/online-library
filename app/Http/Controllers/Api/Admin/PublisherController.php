<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::all();

        if ($publishers) {
            $data = PublisherResource::collection($publishers);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'address' => 'nullable',
            'email' => 'nullable|email',
            'contact_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except('_token');

        $publisher = Publisher::create($params);

        if ($publisher) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Publisher added successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function edit($publisher)
    {
        $publisher = Publisher::whereId($publisher)->first();

        if ($publisher) {
            $data['publisher'] = new PublisherResource($publisher);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function update(Request $request, $publisher)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'address' => 'nullable',
            'email' => 'nullable|email',
            'contact_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $publisher = Publisher::whereId($publisher)->first();

        if (!$publisher) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        $params = $request->except('_token');

        if ($publisher->update($params)) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Publisher updated successfully'], 201);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function destroy($publisher)
    {
        $publisher = Publisher::whereId($publisher)->first();

        if (!$publisher) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($publisher->delete()) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Publisher deleted successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }
}
