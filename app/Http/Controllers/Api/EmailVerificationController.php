<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    /**
     * Send Email Verification
     * 
     * Endpoint ini digunakan untuk mengirimkan email verifikasi ke user.
     * 
     * @authenticated
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Harus berupa email valid.</li>
     * </ul>
     * Example: youremail@gmail.com
     * 
     * 
     */
    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email sudah diverifikasi'
            ];
        }

        $request->user()->sendEmailVerificationNotification();

        return ['status' => 'Link verifikasi telah dikirim'];
    }

    /**
     * Verify User
     * 
     * Endpoint ini digunakan untuk memverifikasi user setelah email verifikasi dikirim.
     * 
     * @authenticated
     * 
     * @urlParam id integer required
     * Id didapatkan pada url yang ada di email verification yang dikirim.<br>
     * Example: 1
     * 
     * @urlParam hash string required
     * Hash didapatkan pada url yang ada di email verification yang dikirim.<br>
     * Example: 80eb661aa0dd5dd1da50f5d62050554c2a5f4af7
     * 
     * 
     */
    public function verify(Request $request)
    {
        auth()->loginUsingId($request->route('id'));

        if ($request->user()->hasVerifiedEmail()) {
            $frontendUrl = env('FRONTEND_URL');
            return redirect($frontendUrl . '/dashboard?message=' . urlencode('Email sudah diverifikasi'));
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        $frontendUrl = env('FRONTEND_URL');
        return redirect($frontendUrl . '/dashboard?message=' . urlencode('Email berhasil diverifikasi'));
    }
}
