<?php

use App\Core\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ReviewController;
use App\Http\Controllers\Api\V1\OrderController;


Route::post('/api/v1/login', [AuthController::class, 'login']);
Route::post('/api/v1/register', [AuthController::class, 'register']);
Route::get('/api/v1/logout', [AuthController::class, 'logout']);


Route::get('/api/v1/products', [ProductController::class, 'index']);
Route::post('/api/v1/products', [ProductController::class, 'store']);

Route::get('/api/v1/orders', [OrderController::class, 'index']);
Route::post('/api/v1/orders', [OrderController::class, 'store']);
Route::delete('/api/v1/orders/{order:\d+}', [OrderController::class, 'destroy']);


Route::get('/api/v1/categories', [CategoryController::class, 'index']);
Route::post('/api/v1/categories', [CategoryController::class, 'store']);

Route::delete('/api/v1/categories/{category:\d+}', [CategoryController::class, 'destroy']);

Route::get('/api/v1/products/{product:\d+}', [ProductController::class, 'show']);

Route::post('/api/v1/products/{product:\d+}/review', [ReviewController::class, 'store']);

