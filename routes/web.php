<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Client\AuthController;

use App\Http\Controllers\Client\HomeController as ClientHomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home',[ClientHomeController::class, 'homeClient'])->name('homeClient');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Route cho trang đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Route cho trang chủ, chỉ truy cập được khi đã đăng nhập
Route::get('/', [HomeController::class, 'test'])->name('home')->middleware('auth');

// Route logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route cho quản lý banner
Route::get('/admin/banner',[BannerController::class, 'showBanner'])->name('showBanner');

Route::get('/admin', [HomeController::class, 'dashboard'])->name('admin.dashboard')->middleware(['auth', 'admin']);

