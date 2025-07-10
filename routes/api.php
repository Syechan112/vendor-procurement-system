<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VendorController;
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/vendor-register', [VendorController::class, 'RegiterVendor']);
    Route::get('/vendor', [VendorController::class, 'index']);
    Route::get('/vendor/{id}', [VendorController::class, 'show']);
    Route::put('/vendor/{id}', [VendorController::class, 'update']);
    Route::delete('/vendor/{id}', [VendorController::class, 'destroy']);

    Route::get('/product', [ProductController::class, 'index']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
