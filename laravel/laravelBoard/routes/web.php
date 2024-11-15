<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('goLogin'); // route('라우트 이름')
});

// 로그인 관련
Route::middleware('guest')->get('/login', [UserController::class, 'goLogin'])->name('goLogin');
Route::middleware('guest')->post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// 게시판 관련
Route::middleware('auth')->resource('/boards', BoardController::class)->except(['update', 'edit']);

// 회원가입 관련
// Route::get('/regist', [UserController::class, 'goRegist'])->name('goRegist');
// Route::post('/regist', [UserController::class, 'regist'])->name('regist');
Route::get('/registration', [UserController::class, 'registration'])->name('get.registration'); // 명사로 쓰는게 좋음
Route::post('/registration', [UserController::class, 'storeRegistration'])->name('post.registration');