<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails())
            return response(['errors' => $validator->errors()->all()], 400);

        $user = User::where('email', $request->username)->first();
        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 201);
            }

            return response(["message" => "Password incorrect"], 400);
        }

        return response(["message" =>'User not found'], 404);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|email',
            'name' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails())
            return response()->json($validator->messages(), 400);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->username;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(10);
        $user->save();

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        return response(['token' => $token], 201);

    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
