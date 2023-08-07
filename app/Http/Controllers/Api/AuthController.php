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
use App\Models\CompetitiveProgramming;
use App\Models\Seminar;
use App\Models\UiuxDesign;
use App\Models\WebDevelopment;

class AuthController extends Controller
{
    /**
     * Register
     * 
     * Endpoint ini digunakan untuk mendaftarkan pengguna baru ke dalam sistem.
     * 
     * @bodyParam name string required
     * <ul>
     *      <li>Maksimal 255 karakter.</li>
     * </ul>
     * Example: Dewa Sheva Dzaky
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Harus berupa email valid.</li>
     *      <li>Maksimal 100 karakter.</li>
     *      <li>Harus unique (tidak boleh email yang telah terdaftar).</li>
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
     * Example: Srifoton2023
     * 
     * @bodyParam password_confirmation string required
     * Example: Srifoton2023
     */
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($user);
        $user = User::find($user->id);

        if ($user) {
            return response()->json([
                'messages' => 'Berhasil daftar',
                'token' => $token,
                'user' => $user
            ]);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    /**
     * Login
     * 
     * Endpoint ini digunakan untuk melakukan proses autentikasi dan login pengguna ke dalam sistem.
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Harus berupa email valid.</li>
     * </ul>
     * Example: youremail@gmail.com
     * 
     * @bodyParam password string required
     * Example: Srifoton2023
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $token = JWTAuth::fromUser(Auth::guard('api')->user());

        return response()->json([
            'message' => 'Berhasil login',
            'token' => $token,
            'user' => Auth::guard('api')->user()
        ]);
    }

    /**
     * Logout
     * 
     * Endpoint ini digunakan untuk melakukan proses logout pengguna dari sistem.
     * 
     * @authenticated
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'message' => 'Berhasil log out'
        ]);
    }

    /**
     * Get Data User
     * 
     * Endpoint ini digunakan untuk mendapatkan data dari user yang sudah login dan data kompetisi/seminar terdaftar.
     * 
     * @authenticated
     */
    public function me()
    {
        $user = Auth::guard('api')->user();
        $competitions = $this->getCompetitions($user->id);
        $seminar = Seminar::where('user_id', $user->id)->first();

        $user['registered'] = [
            'competitions' => $competitions,
            'seminar' => $seminar
        ];

        return response()->json($user);
    }

    private function getCompetitions($userId)
    {
        $programming = CompetitiveProgramming::where('user_id', $userId)->first();
        $uiux = UiuxDesign::where('user_id', $userId)->first();
        $webdev = WebDevelopment::where('user_id', $userId)->first();

        return [
            'competitive_programming' => $programming,
            'uiux_design' => $uiux,
            'web_development' => $webdev,
        ];
    }
}
