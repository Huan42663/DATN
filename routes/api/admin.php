<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('colors', ColorController::class);
Route::apiResource('sizes', SizeController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('vouchers', VoucherController::class);
Route::apiResource('home', HomeController::class);
Route::apiResource('posts', PostController::class);



Route::apiResource('category-product', CategoryProductController::class);
Route::apiResource('category-post', CategoryPostController::class);
Route::apiResource('events', EventController::class);
Route::apiResource('users', UserController::class);

Route::apiResource('banners', BannerController::class);
Route::put('banners/{id}', [BannerController::class, 'update']);

Route::apiResource('products', ProductController::class);
Route::get('products/{id}/rates', [ProductController::class, 'getRates']);
