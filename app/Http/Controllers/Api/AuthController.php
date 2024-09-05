<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            $data = [
                'ok' => false,
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->role) {
            $userData['role'] = $request->role;
        }

        $user = User::create($userData);

        if (!$user) {
            $data = [
                'ok' => false,
                'message' => 'user not save.',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'ok' => true,
            'msg' => 'User created',
            'user' => $user,
            'accessToken' => $token
        ], 201);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            $data = [
                'ok' => false,
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'ok' => false,
                'msg' => "Unauthorized",
            ], 400);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('Personal Access Token')->plainTextToken;
        return response()->json([
            'ok' => true,
            'user' => $user,
            'accessToken' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'ok' => true,
        ], 200);
    }
}
