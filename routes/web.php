<?php
session_start();

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
        Route::post('/', [SizeController::class, 'store'])->name('Administration.sizes.store'); 
        Route::get('/{size_id}', [SizeController::class, 'show'])->name('Administration.sizes.show'); 
        Route::put('/{size}', [SizeController::class, 'update'])->name('Administration.sizes.update');
        Route::delete('/{size}', [SizeController::class, 'destroy'])->name('Administration.sizes.destroy');
    });

    // ROUTE COLOR
    Route::prefix('colors')->group(function () {
        Route::get('/', [ColorController::class, 'index'])->name('Administration.colors.list'); 
        Route::post('/', [ColorController::class, 'store'])->name('Administration.colors.store'); 
        Route::get('/{color_id}', [ColorController::class, 'show'])->name('Administration.colors.show'); 
        Route::put('/{color}', [ColorController::class, 'update'])->name('Administration.colors.update');
        Route::delete('/{color}', [ColorController::class, 'destroy'])->name('Administration.colors.destroy');
    });

    // ROUTE POST
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('Administration.posts.list'); 
        Route::get('/create', [PostController::class, 'create'])->name('Administration.posts.create'); 
        Route::post('/create', [PostController::class, 'store'])->name('Administration.posts.store');
        Route::get('/{slug}', [PostController::class, 'show'])->name('Administration.posts.show'); 
        Route::put('/{post}', [PostController::class, 'update'])->name('Administration.posts.update');
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
        Route::get('/create-variant', [ProductController::class, 'createVariant'])->name('Administration.products.create-variant');
        Route::get('/create-variant-update', [ProductController::class, 'createVariantUpdate'])->name('Administration.products.create-variant-update');
        Route::post('/create-variant-update1', [ProductController::class, 'createVariantUpdate1'])->name('Administration.products.create-variant-update1');
        Route::post('/create-variant-update', [ProductController::class, 'createVariant2'])->name('Administration.products.createVariant2');
        Route::post('/create-variant', [ProductController::class, 'createVariant1'])->name('Administration.products.createVariant1');
        Route::post('/delte-variant', [ProductController::class, 'deleteVariant'])->name('Administration.products.deleteVariant');
        Route::post('/create', [ProductController::class, 'store'])->name('Administration.products.store');
        Route::get('/show-{product_slug}', [ProductController::class, 'show'])->name('Administration.products.show');
        Route::get('/{product_slug}/edit', [ProductController::class, 'edit'])->name('Administration.products.edit');
        Route::put('/{product_slug}', [ProductController::class, 'update'])->name('Administration.products.update');
        Route::delete('/delete-multiple', [ProductController::class, 'deleteMultiple'])->name('Administration.products.deleteMultiple');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('Administration.products.destroy');
        Route::post('/delete-image', [ProductController::class, 'destroyImage'])->name('Administration.products.destroyImage');
        Route::post('/create-list-images', [ProductController::class, 'createListImages'])->name('Administration.products.createListImages');
    });

    // ROUTE CATEGORY PRODUCT
    Route::prefix('category-product')->group(function () {
        Route::get('/', [CategoryProductController::class, 'index'])->name('Administration.categoryProduct.list');
        Route::get('/create', [CategoryProductController::class, 'create'])->name('Administration.categoryProduct.create');
        Route::post('/create', [CategoryProductController::class, 'store'])->name('Administration.categoryProduct.store');
        Route::get('/{slug}', [CategoryProductController::class, 'show'])->name('Administration.categoryProduct.show');
        Route::get('/{category}/edit', [CategoryProductController::class, 'edit'])->name('Administration.categoryProduct.edit');
        Route::put('/{category}/update', [CategoryProductController::class, 'update'])->name('Administration.categoryProduct.update');
        Route::delete('/{category}', [CategoryProductController::class, 'destroy'])->name('Administration.categoryProduct.destroy');
    });

    // ROUTE  CATEGORY POST
    Route::prefix('category-post')->group(function () {
        Route::get('/', [CategoryPostController::class, 'index'])->name('Administration.categoryPost.list');
        Route::get('/create', [CategoryPostController::class, 'create'])->name('Administration.categoryPost.create');
        Route::post('/create', [CategoryPostController::class, 'store'])->name('Administration.categoryPost.store');
        Route::get('/{slug}', [CategoryPostController::class, 'show'])->name('Administration.categoryPost.show');
        Route::get('/{category}/edit', [CategoryPostController::class, 'edit'])->name('Administration.categoryPost.edit');
        Route::put('/{category}', [CategoryPostController::class, 'update'])->name('Administration.categoryPost.update');
        Route::delete('/{category}', [CategoryPostController::class, 'destroy'])->name('Administration.categoryPost.destroy');
    });

    // ROUTE BANNER
    Route::prefix('banners')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('Administration.banners.index');
        Route::get('/create', [BannerController::class, 'create'])->name('Administration.banners.create');
        Route::post('/create', [BannerController::class, 'store'])->name('Administration.banners.store');
        Route::get('/{banner}', [BannerController::class, 'show'])->name('Administration.banners.show');
        Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('Administration.banners.edit');
        Route::put('/update/{banner}', [BannerController::class, 'update'])->name('Administration.banners.update');
        Route::delete('/destroy/{banner}', [BannerController::class, 'destroy'])->name('Administration.banners.destroy');
    });

    // ROUTE EVENT
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('Administration.events.list');
        Route::get('/create', [EventController::class, 'create'])->name('Administration.events.create');
        Route::post('/create', [EventController::class, 'store'])->name('Administration.events.store');
        Route::get('/show/{event}', [EventController::class, 'show'])->name('Administration.events.show');
        Route::put('/show-add/{event}', [EventController::class, 'add'])->name('Administration.events.show-add');
        Route::put('/show-remove/{event}', [EventController::class, 'remove'])->name('Administration.events.show-remove');
        Route::get('/edit/{event}', [EventController::class, 'edit'])->name('Administration.events.edit');
        Route::put('/update/{event}', [EventController::class, 'update'])->name('Administration.events.update');
        Route::delete('/destroy/{event}', [EventController::class, 'destroy'])->name('Administration.events.destroy');
    });

    // ROUTE USER
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('Administration.users.list');
        Route::get('/create', [UserController::class, 'create'])->name('Administration.users.create');
        Route::post('/create', [UserController::class, 'store'])->name('Administration.users.store');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('Administration.users.show');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('Administration.users.update');
        Route::put('/destroy/{user}', [UserController::class, 'destroy'])->name('Administration.users.destroy');
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
    Route::get('cart', [CartController::class,'index'])->name('Client.cart.list');
    Route::post('cart', [CartController::class,'UpdateCartDetail'])->name('Client.cart.update');
    Route::delete('cart', [CartController::class,'DestroyCart'])->name('Client.cart.destroy');

    // ROUTE ACCOUNT USER, LOGIN, REGISTER, FORGOT PASSWORD
    Route::get('account', [AuthController::class, 'show'])->name('Client.account.show');
    Route::put('account', [AuthController::class, 'update'])->name('Client.account.update');
    Route::put('forgotPassword', [AuthController::class, 'update'])->name('Client.account.update');
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('Client.account.showLoginForm');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('Client.account.logout');
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('Client.account.showRegisterForm');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    // ROUTE POST
    Route::get('posts/{slug}', [ClientPostController::class, 'index'])->name('Client.posts.category');
    Route::get('posts/detail-{slug}', [ClientPostController::class, 'index'])->name('Client.posts.detail');

    // ROUTE ORDER
    Route::get('orders', [ClientOrderController::class, 'index'])->middleware('auth')->name('Client.orders.list');
    Route::get('orders/create', [ClientOrderController::class, 'create'])->name('Client.orders.create');
    Route::post('orders', [ClientOrderController::class, 'store'])->name('Client.orders.store');
    Route::get('orders/{order_code}/{order_id}', [ClientOrderController::class, 'show'])->middleware('auth')->name('Client.orders.show');
    Route::put('orders/{order}', [ClientOrderController::class, 'show'])->name('Client.orders.update');
    Route::post('order/{order_code}/{order_id}/cancel', [CLientOrderController::class, 'cancel'])->middleware('auth')->name('Client.orders.cancel');
    Route::post('order/{order_code}/{order_id}/confirmDelivered', [CLientOrderController::class, 'confirmDelivered'])->middleware('auth')->name('Client.orders.confirmDelivered');

  

    // ROUTE EVENT
    // Route::get('events/',[ClientEventController::class],'list')->name('Client.events.list');
    // Route::get('events/{slug}',[ClientEventController::class],'show')->name('Client.events.show');


})->name('Client');

