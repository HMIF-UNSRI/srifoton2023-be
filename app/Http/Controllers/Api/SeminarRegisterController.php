<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeminarRegisterRequest;
use App\Models\Seminar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeminarRegisterController extends Controller
{

    public function register(SeminarRegisterRequest $request)
    {
        $request->validated();

        $user = Auth::user();

        $proofImageName = Str::random(16) . "." . $request->proof->getClientOriginalExtension();

        $seminar = Seminar::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'proof' => $proofImageName,
            'payment_method' => $request->payment_method,
        ]);

        Storage::disk('public')->put($proofImageName, file_get_contents($request->proof));

        return response()->json([
            'message' => 'Berhasil mendaftar seminar',
            'data' => [
                'seminar' => $seminar
            ]
        ]);
    }
}
