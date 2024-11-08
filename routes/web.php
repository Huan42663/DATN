<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ProductController as CLientProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\HomeController as CLientHomeController;
use App\Http\Controllers\Client\OrderController as CLientOrderController;
use App\Http\Controllers\Client\PostController as CLientPostController;
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


// ROUTE ADMIN
Route::prefix('/Administration')->group(function () {

    // ROUTE HOME
    Route::get('/', [HomeController::class, 'index'])->name('Administration.Home');

    // ROUTE ORDER
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('Administration.orders.list');
        Route::get('detail-{order_code}', [OrderController::class, 'show'])->name('Administration.orders.show');
        Route::put('/{order}', [OrderController::class, 'update'])->name('Administration.orders.update');
    });

    // ROUTE SIZE
    Route::prefix('sizes')->group(function () {
        Route::get('/', [SizeController::class, 'index'])->name('Administration.sizes.list');
        Route::get('/create', [SizeController::class, 'create'])->name('Administration.sizes.create');
        Route::post('/create', [SizeController::class, 'store'])->name('Administration.sizes.store');
        Route::get('/{size_name}', [SizeController::class, 'show'])->name('Administration.sizes.show');
        Route::put('/{size}', [SizeController::class, 'update'])->name('Administration.sizes.update');
        Route::delete('/{size}', [SizeController::class, 'destroy'])->name('Administration.sizes.destroy');
    });

    // ROUTE COLOR
    Route::prefix('colors')->group(function () {
        Route::get('/', [ColorController::class, 'index'])->name('Administration.colors.list');
        Route::get('/create', [ColorController::class, 'create'])->name('Administration.colors.create');
        Route::post('/create', [ColorController::class, 'store'])->name('Administration.colors.store');
        Route::get('/{color_name}', [ColorController::class, 'show'])->name('Administration.colors.show');
        Route::put('/{color}', [ColorController::class, 'update'])->name('Administration.colors.update');
        Route::delete('/{color}', [ColorController::class, 'destroy'])->name('Administration.colors.delete');
    });

    // ROUTE POST
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('Administration.posts.list');
        Route::get('/create', [PostController::class, 'create'])->name('Administration.posts.create');
        Route::post('/create', [PostController::class, 'store'])->name('Administration.posts.store');
        Route::get('/{slug}', [PostController::class, 'show'])->name('Administration.posts.show');
        Route::put('/{post', [PostController::class, 'update'])->name('Administration.posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('Administration.posts.destroy');
    });

    // ROUTE VOUCHER
    Route::prefix('vouchers')->group(function () {
        Route::get('/', [VoucherController::class, 'index'])->name('Administration.vouchers.list');
        Route::get('/create', [VoucherController::class, 'create'])->name('Administration.vouchers.create');
        Route::post('/create', [VoucherController::class, 'store'])->name('Administration.vouchers.store');
        Route::get('/{voucher_code}', [VoucherController::class, 'show'])->name('Administration.vouchers.show');
        Route::put('/{voucher}', [VoucherController::class, 'update'])->name('Administration.vouchers.update');
        Route::delete('/{voucher}', [VoucherController::class, 'destroy'])->name('Administration.vouchers.destroy');
    });

    // ROUTE PRODUCT
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('Administration.products.list');
        Route::get('/create', [ProductController::class, 'create'])->name('Administration.products.create');
        Route::post('/create', [ProductController::class, 'store'])->name('Administration.products.store');
        Route::get('/{slug}', [ProductController::class, 'show'])->name('Administration.products.show');
        Route::put('/{product}', action: [ProductController::class, 'update'])->name('Administration.products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('Administration.products.destroy');
    });

    // ROUTE CATEGORY PRODUCT
    Route::prefix('category-product')->group(function () {
        Route::get('/', [CategoryProductController::class, 'index'])->name('Administration.categoryProduct.list');
        Route::get('/create', [CategoryProductController::class, 'create'])->name('Administration.categoryProduct.create');
        Route::post('/create', [CategoryProductController::class, 'store'])->name('Administration.categoryProduct.store');
        Route::get('/{slug}', [CategoryProductController::class, 'show'])->name('Administration.categoryProduct.show');
        Route::put('/{category}', [CategoryProductController::class, 'update'])->name('Administration.categoryProduct.update');
        Route::delete('/{category}', [CategoryProductController::class, 'destroy'])->name('Administration.categoryProduct.destroy');
    });

    // ROUTE  CATEGORY POST
    Route::prefix('category-post')->group(function () {
        Route::get('/', [CategoryPostController::class, 'index'])->name('Administration.categoryPost.list');
        Route::get('/create', [CategoryPostController::class, 'create'])->name('Administration.categoryPost.create');
        Route::post('/create', [CategoryPostController::class, 'store'])->name('Administration.categoryPost.store');
        Route::get('/{slug}', [CategoryPostController::class, 'show'])->name('Administration.categoryPost.show');
        Route::put('/{category}', [CategoryPostController::class, 'update'])->name('Administration.categoryPost.update');
        Route::delete('/{category}', [CategoryPostController::class, 'destroy'])->name('Administration.categoryPost.destroy');
    });

    // ROUTE BANNER
    Route::prefix('banners')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('Administration.banners.list');
        Route::get('/create', [BannerController::class, 'create'])->name('Administration.banners.create');
        Route::post('/create', [BannerController::class, 'store'])->name('Administration.banners.store');
        Route::get('/{banner}', [BannerController::class, 'show'])->name('Administration.banners.show');
        Route::put('/{banner}', [BannerController::class, 'update'])->name('Administration.banners.update');
        Route::delete('/{banner}', [BannerController::class, 'destroy'])->name('Administration.banners.destroy');
    });

    // ROUTE EVENT
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('Administration.events.list');
        Route::get('/create', [EventController::class, 'create'])->name('Administration.events.create');
        Route::post('/create', [EventController::class, 'store'])->name('Administration.events.store');
        Route::get('/{slug}', [EventController::class, 'show'])->name('Administration.events.show');
        Route::put('/{event}', [EventController::class, 'update'])->name('Administration.events.update');
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('Administration.events.destroy');
    });

    // ROUTE USER
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('Administration.users.list');
        Route::get('/create', [UserController::class, 'create'])->name('Administration.users.create');
        Route::post('/create', [UserController::class, 'store'])->name('Administration.users.store');
        Route::get('/{email}', [UserController::class, 'show'])->name('Administration.users.show');
        Route::put('/{user}', [UserController::class, 'update'])->name('Administration.users.update');
        Route::put('/{user}', [UserController::class, 'destroy'])->name('Administration.users.destroy');
    });
})->name('Administration');

//ROUTE CLient

Route::prefix('/')->group(function () {

    // ROUTE HOME
    Route::get('/', [HomeController::class, 'index'])->name('Client.Home');

    // ROUTE PRODUCT
    Route::get('products', [CLientProductController::class, 'index'])->name('Client.product.list');
    Route::get('products/search?{keyword}', [CLientProductController::class, 'index'])->name('Client.product.search');
    Route::get('products/{slug}', [CLientProductController::class, 'index'])->name('Client.product.category');
    Route::get('products/detail-{slug}', [CLientProductController::class, 'index'])->name('Client.product.detail');

    // ROUTE CART
    Route::get('cart', [CartController::class, 'index'])->name('Client.cart.list');
    Route::put('cart/{product}', [CartController::class, 'update'])->name('Client.cart.update');
    Route::delete('cart/{product}', [CartController::class, 'destroy'])->name('Client.cart.destroy');

    // ROUTE ACCOUNT USER, LOGIN, REGISTER, FORGOT PASSWORD
    Route::get('account', [AuthController::class, 'show'])->name('Client.account.show');
    Route::put('account', [AuthController::class, 'update'])->name('Client.account.update');
    Route::put('forgotPassword', [AuthController::class, 'update'])->name('Client.account.update');
    Route::get('login', [AuthController::class, 'login'])->name('Client.account.login');
    Route::get('logout', [AuthController::class, 'logout'])->name('Client.account.logout');
    Route::get('register', [AuthController::class, 'register'])->name('Client.account.register');

    // ROUTE POST
    Route::get('posts/{slug}', [ClientPostController::class, 'index'])->name('Client.posts.category');
    Route::get('posts/detail-{slug}', [ClientPostController::class, 'index'])->name('Client.posts.detail');

    // ROUTE ORDER
    Route::get('orders', [ClientOrderController::class, 'index'])->name('Client.orders.list');
    Route::get('orders/create', [ClientOrderController::class, 'create'])->name('Client.orders.create');
    Route::post('orders', [ClientOrderController::class, 'store'])->name('Client.orders.store');
    Route::get('orders/{order}', [ClientOrderController::class, 'show'])->name('Client.orders.show');
    Route::put('orders/{order}', [ClientOrderController::class, 'show'])->name('Client.orders.update');

    // ROUTE EVENT
    // Route::get('events/',[ClientEventController::class],'list')->name('Client.events.list');
    // Route::get('events/{slug}',[ClientEventController::class],'show')->name('Client.events.show');


})->name('Client');
