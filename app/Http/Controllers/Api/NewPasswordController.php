<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;

class NewPasswordController extends Controller
{
    /**
     * Send Email Forgot password
     * 
     * Endpoint ini digunakan untuk mengirimkan email ke user yang lupa password.
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Harus berupa email valid.</li>
     *      <li>Harus berupa email yang telah terdaftar pada sistem.</li>
     * </ul>
     * Example: youremail@gmail.com
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        };

        throw ValidationException::withMessages([
            'email' => [trans($status)]
        ]);
    }

    /**
     * Reset Password
     * 
     * Endpoint ini digunakan membuat password baru setelah user lupa password.
     * 
     * @bodyParam token string required
     * Token bisa didapat pada url yang ada di email forgot password yang dikirim.<br>
     * Example: 56b9a87f2bef89a72692141c28a886cfcc1eac770e24f5bb43945b7c8f6d2fa4
     * 
     * @bodyParam email string required
     * Email bisa didapat pada url yang ada di email forgot password yang dikirim.<br>
     * <ul>
     *      <li>Harus berupa email valid.</li>
     *      <li>Harus email yang sama dengan email saat mengirimkan email forgot password.</li>
     * </ul>
     * Example: youremail@gmail.com
     * 
     * @bodyParam password string required
     * <ul>
     *      <li>Minimal 8 karakter.</li>
     *      <li>Harus terdapat huruf besar dan kecil.</li>
     *      <li>Harus terdapat angka.</li>
     *      <li>Harus sama dengan password_confirmation.</li>
     * </ul>
     * Example: PakeNanya123
     * 
     * @bodyParam password_confirmation string required
     * Example: PakeNanya123
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                RulesPassword::min(8)->mixedCase()->numbers()
            ]
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message' => 'Reset password berhasil'
            ]);
        }

        return response([
            'message' => __($status)
        ], 500);
    }
}
