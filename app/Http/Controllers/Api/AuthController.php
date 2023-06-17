<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        if ($user) {
            return response()->json([
                'messages' => 'Berhasil daftar',
                'token' => $token,
            ]);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $token = JWTAuth::fromUser(Auth::guard('api')->user());

        return response()->json([
            'message' => 'Berhasil login',
            'token' => $token
        ]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'message' => 'Berhasil log out'
        ]);
    }

    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }

}
