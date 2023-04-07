<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/admin/login',  [AdminAuthController::class, 'store'])->name('admin.login');
Route::post('/admin/create', [AdminUserController::class, 'store'])->name('admin.create');

Route::post('/user/login',            [UserAuthController::class, 'store'])->name('user.login');
Route::post('/user/forgot-password',  [PasswordResetLinkController::class, 'store'])->name('password.forgot');
Route::post('/user/reset-password',   [NewPasswordController::class, 'store'])->name('password.reset');

Route::prefix('main')->group(function () {
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');

    Route::apiResource('blog', BlogController::class)->only(['index', 'show']);
});

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('brands',     BrandController::class)->only(['index', 'show']);

Route::middleware('auth:api')->group(function () {
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::apiResource('users', UserController::class)->except(['show', 'store']);

        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
    });

    Route::apiSingleton('user',           UserProfileController::class)->creatable();
    Route::apiResource('categories',      CategoryController::class)->except(['index', 'show']);
    Route::apiResource('brands',          BrandController::class)->except(['index', 'show']);
    Route::apiResource('orders',          OrderController::class);
    Route::apiResource('order-statuses',  OrderStatusController::class);

    Route::get('/user/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::post('/logout',     [UserAuthController::class, 'destroy'])->name('user.logout');
});
