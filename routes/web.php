<?php

use App\Http\Controllers\Admin\BannerController;
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

// Route cho Banner
Route::prefix('admin/banners')->group(function () {
    Route::get('/', [BannerController::class, 'index']); // Lấy danh sách banner
    Route::get('/{id}', [BannerController::class, 'show']); // Lấy thông tin chi tiết banner
    Route::post('/', [BannerController::class, 'store']); // Tạo mới banner
    Route::put('/{banner_id}', [BannerController::class, 'update']); // Cập nhật banner
    Route::delete('/{banner_id}', [BannerController::class, 'destroy']); // Xóa banner
});
