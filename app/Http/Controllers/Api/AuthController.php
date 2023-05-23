<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

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

        $token = $user->createToken('authtoken')->plainTextToken;

        return response()->json([
            'messages' => 'User berhasil terdaftar',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $token = $request->user()->createToken('authtoken')->plainTextToken;

        return response()->json([
            'message' => 'Berhasil login',
            'data' => [
                'token' => $token,
                'user' => $request->user()
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Berhasil logout'
        ]);
    }

    public function me() {
        return response()->json(Auth::user());
    }
}
