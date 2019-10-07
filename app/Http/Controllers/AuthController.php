<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string'],
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors(),
            ]);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');

        $token = JWTAuth::attempt($data);

        if ($token) {
            return response()->json([
                'status' => true,
                'token' => $token,
            ]);
        }
    }
}
