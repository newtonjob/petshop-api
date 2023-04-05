<?php

use App\Http\Controllers\Api\AdminAuthController;
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

Route::middleware('auth:api')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
    });
});


