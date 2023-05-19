<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    public function forgotPassword(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus berisi format email yang valid.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        };

        throw ValidationException::withMessages([
            'email' => [trans($status)]
        ]);
    }
}
