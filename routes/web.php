<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\CompetitiveProgrammingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\MobileLegendController;
use App\Http\Controllers\Admin\SeminarController;
use App\Http\Controllers\Admin\UIUXDesignController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebDevelopmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:admin')->group(function () {
    Route::prefix('dashboard/admin')->group(function () {
        Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard');
        Route::get('/competitive-programming', [CompetitiveProgrammingController::class, 'index'])->name('competition.cp');
        Route::get('/uiux-design', [UIUXDesignController::class, 'index'])->name('competition.uiux');
        Route::get('/web-development', [WebDevelopmentController::class, 'index'])->name('competition.webdev');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');


        // MobileLegends
        Route::get('/mobile-legends', [MobileLegendController::class, 'index'])->name('competition.mole');
        Route::get('/mobile-legends/{id}', [MobileLegendController::class, 'show'])->name('competition.mole.show');
        Route::post('/mobile-legends/{id}/verification', [MobileLegendController::class, 'update'])->name('competition.mole.verification');
        Route::delete('/mobile-legends/{id}/delete', [MobileLegendController::class, 'delete'])->name('competition.mole.delete');



        Route::get('/seminar', [SeminarController::class, 'seminar'])->name('seminar');


    });

    Route::get('srifoton2023/logout-admin', [AuthAdminController::class, 'logout'])->name('logout');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('srifoton2023/login-admin', [AuthAdminController::class, 'index']);
    Route::post('srifoton2023/login-admin', [AuthAdminController::class, 'login'])->name('login');
});