<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompetitiveProgrammingController;
use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\Api\MobileLegendController;
use App\Http\Controllers\Api\DashboardUserController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\SeminarController;
use App\Http\Controllers\Api\UiuxDesignController;
use App\Http\Controllers\Api\WebDevelopmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Register
Route::post('register', [AuthController::class, 'register']);
// Login
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // Get data user
    Route::get('me', [AuthController::class, 'me']);
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);
    // Send Email Verification
    Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail']);

    Route::middleware('verified')->group(function () {
        // Update data user
        Route::put('update-data-user', [DashboardUserController::class, 'update']);

        // Seminar Registration
        Route::post('seminar/register', [SeminarController::class, 'register']);

        // Competition (Mobile legends)
        Route::post('mobile-legends/register', [MobileLegendController::class, 'register']);
        // Competition (Competitive Programming)
        Route::post('competitive-programming/register', [CompetitiveProgrammingController::class, 'register']);
        // Competition (UIUX Design)
        Route::post('uiux-design/register', [UiuxDesignController::class, 'register']);
        // Competition (Web Development)
        Route::post('web-development/register', [WebDevelopmentController::class, 'register']);
    });
});

// Verify Email
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('signed');
// Send email forgot password
Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
// Reset password
Route::post('reset-password', [NewPasswordController::class, 'resetPassword']);