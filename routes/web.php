<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SeminarController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\UiuxDesignController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\WebDevelopmentController;
use App\Http\Controllers\Admin\CompetitiveProgrammingController;

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
        Route::get('/uiux-design', [UIUXDesignController::class, 'index'])->name('competition.uiux');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

        // Competitive Programming
        Route::get('/competitive-programming', [CompetitiveProgrammingController::class, 'index'])->name('competition.cp');
        Route::get('/competitive-programming/{id}/show', [CompetitiveProgrammingController::class, 'show'])->name('competition.cp.show');
        Route::post('/competitive-programming/{id}/verification', [CompetitiveProgrammingController::class, 'update'])->name('competition.cp.verification');
        Route::delete('/competitive-programming/{id}/delete', [CompetitiveProgrammingController::class, 'delete'])->name('competition.cp.delete');

        // Web Development
        Route::get('/web-development', [WebDevelopmentController::class, 'index'])->name('competition.webdev');
        Route::get('/web-development/{id}/show', [WebDevelopmentController::class, 'show'])->name('competition.webdev.show');
        Route::post('/web-development/{id}/verification', [WebDevelopmentController::class, 'update'])->name('competition.webdev.verification');
        Route::delete('/web-development/{id}/delete', [WebDevelopmentController::class, 'delete'])->name('competition.webdev.delete');
        Route::get('/web-development/{id}/download', [WebDevelopmentController::class, 'downloadSubmission'])->name('competition.webdev.download');

        // Uiux Design
        Route::get('/uiux-design', [UiuxDesignController::class, 'index'])->name('competition.uiux');
        Route::get('/uiux-design/{id}/show', [UiuxDesignController::class, 'show'])->name('competition.uiux.show');
        Route::post('/uiux-design/{id}/verification', [UiuxDesignController::class, 'update'])->name('competition.uiux.verification');
        Route::delete('/uiux-design/{id}/delete', [UiuxDesignController::class, 'delete'])->name('competition.uiux.delete');
        Route::get('/uiux-design/{id}/download', [UiuxDesignController::class, 'downloadSubmission'])->name('competition.uiux.download');
        Route::get('/uiux-design/download-all', [UiuxDesignController::class, 'downloadAllSubmission'])->name('competition.uiux.all.download');


    
        //Seminar
        Route::get('/seminar', [SeminarController::class, 'index'])->name('seminar');
        Route::get('/seminar/{id}/show', [SeminarController::class, 'show'])->name('seminar.show');
        Route::post('/seminar/{id}/verification', [SeminarController::class, 'update'])->name('seminar.verification');
        Route::delete('/seminar/{id}/delete', [SeminarController::class, 'delete'])->name('seminar.delete');

    });

    Route::get('srifoton2023/logout-admin', [AuthAdminController::class, 'logout'])->name('logout');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('srifoton2023/login-admin', [AuthAdminController::class, 'index']);
    Route::post('srifoton2023/login-admin', [AuthAdminController::class, 'login'])->name('login');
});