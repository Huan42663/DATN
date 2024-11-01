<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Client\CategoryProductController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\PostController;

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

Route::middleware('auth:sanctum')->get('/user',function(Request $request){
    return $request->user(); 
});

Route::apiResource('posts', PostController::class);
// tạo đơn hàng
Route::post('/orders', [OrderController::class, 'store']);
///list test
Route::get('/orders', [OrderController::class, 'index']);

Route::get('product-detail/{slug}', [ProductController::class, 'productDetail']);

Route::get('home', [HomeController::class,'index']);
Route::get('cart', [CartController::class,'index']);
Route::post('cart', [CartController::class,'store']);
Route::put('cart/{cart}', [CartController::class,'UpdateCartDetail']);
Route::delete('cart/{id}', [CartController::class,'DestroyCart']);


