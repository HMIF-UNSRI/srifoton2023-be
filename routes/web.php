<?php

use App\Http\Controllers\Admin\AuthAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;

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

Route::get('dashboard/admin', [DashboardAdminController::class, 'index']);

Route::get('srifoton2023/login-admin', [AuthAdminController::class, 'index']);
