<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\UserOrderController;
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

Route::post('/user/login', [UserAuthController::class, 'store'])->name('user.login');

Route::middleware('auth:api')->group(function () {
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::apiResource('users', UserController::class)->except(['show', 'store']);

        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
    });

    Route::apiSingleton('user', UserProfileController::class)->creatable();

    Route::get('/user/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::post('/logout',     [UserAuthController::class, 'destroy'])->name('user.logout');
});


