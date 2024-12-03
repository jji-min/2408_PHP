<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
Route::middleware('my.auth')->group(function() {
    // 인증 관련
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/reissue', [AuthController::class, 'reissue'])->name('auth.reissue');

    // 게시글 관련
    Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
    Route::get('/boards/{id}', [BoardController::class, 'show'])->name('boards.show');
    Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');
    Route::delete('/boards/{id}', [BoardController::class, 'destroy'])->name('boards.destroy');
});