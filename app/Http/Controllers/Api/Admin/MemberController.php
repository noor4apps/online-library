<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('is_admin', 0)->select('id', 'first_name', 'last_name', 'contact_number', 'address', 'email')->get();

        if ($members) {
            $data = UserResource::collection($members);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'contact_number' => 'required',
            'address' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except('_token');

        $member = User::create($params);

        if ($member) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Member added successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function edit($member)
    {
        $member = User::whereId($member)->select('id', 'first_name', 'last_name', 'contact_number', 'address', 'email')->first();

        if ($member) {
            $data['member'] = new UserResource($member);
            return response()->json(['data' => $data, 'error' => 0, 'message' => ''], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function update(Request $request, $member)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'contact_number' => 'required',
            'address' => 'nullable',
            'email' => 'required|unique:users,email,' . $member,
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $params = $request->except(['_token', 'password']);

        $params['password'] = bcrypt($request->password);

        $member = User::whereId($member)->select('id', 'first_name', 'last_name', 'contact_number', 'address', 'email')->first();

        if (!$member) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($member->update($params)) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Member updated successfully'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }

    public function destroy($member)
    {
        $member = User::whereId($member)->select('id', 'email')->first();

        if (!$member) {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
        }

        if ($member->delete()) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'Member deleted successfully.'], 200);
        }

        return response()->json(['data' => null, 'error' => 1, 'message' => 'Something went wrong!'], 201);
    }
}
