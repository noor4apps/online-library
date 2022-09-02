<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 201);
        }

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            $user = auth()->user();

            $data['user'] = new UserResource($user);
            $data['token'] = $user->createToken('api-token')->plainTextToken;

            return response()->json(['data' => $data, 'error' => 0, 'message' => 'You are logged in successfully'], 200);

        } else {
            return response()->json(['data' => null, 'error' => 1, 'message' =>  __('auth.failed')], 201);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validator->fails()) {
            return response()->json(['data' => null, 'error' => 1, 'message' => $validator->errors()->first()], 200);
        }

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'contact_number' => $request['contact_number'],
            'address' => $request['address'],
            'is_admin' => 0,
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $data['user'] = new UserResource($user);
        $data['token'] = $user->createToken('api-token')->plainTextToken;

        return response()->json(['data' => $data, 'error' => 0, 'message' => 'Successfully Registered'], 200);
    }

    public function logout()
    {
        $user = auth()->user();

        if ($user->tokens()->delete()) {
            return response()->json(['data' => null, 'error' => 0, 'message' => 'logged out'], 200);
        } else {
            return response()->json(['data' => null, 'error' => 1, 'message' => 'something went wrong!'], 201);
        }

    }

}
