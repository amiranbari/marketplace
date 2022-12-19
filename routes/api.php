<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('admin-protected')->group(function () {
    Route::apiResource('roles', RoleController::class);
});

Route::post('login', [LoginController::class, 'login']);

Route::middleware('customer-protected')->prefix('customers')->group(function () {
    Route::get('nearby/sellers', [SellerController::class, 'nearby']);
});

Route::middleware('seller-protected')->group(function () {
    
});


