<?php

use App\Http\Controllers\Admin\AuthAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserAdminController;

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

Route::middleware('auth:admin')->group(function(){
    Route::get('dashboard/admin', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::get('dashboard/admin/users', [DashboardAdminController::class, 'users'])->name('users');
    Route::get('dashboard/admin/competitive-programming', [DashboardAdminController::class, 'competitive_programming'])->name('competition.cp');
    Route::get('dashboard/admin/uiux-design', [DashboardAdminController::class, 'uiux_design'])->name('competition.uiux');
    Route::get('dashboard/admin/web-development', [DashboardAdminController::class, 'web_development'])->name('competition.webdev');
    Route::get('dashboard/admin/mobile-legends', [DashboardAdminController::class, 'mobile_legends'])->name('competition.mole');
    Route::get('dashboard/admin/seminar', [DashboardAdminController::class, 'seminar'])->name('seminar');
    Route::get('srifoton2023/logout-admin', [AuthAdminController::class, 'logout'])->name('logout');
});

Route::middleware('guest:admin')->group(function(){
    Route::get('srifoton2023/login-admin', [AuthAdminController::class, 'index']);
    Route::post('srifoton2023/login-admin', [AuthAdminController::class, 'login'])->name('login');
});
