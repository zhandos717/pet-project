<?php

use App\Core\Route;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ReviewController;


Route::get('/api/v1/products', [ProductController::class, 'index']);

Route::post('/api/v1/products', [ProductController::class, 'store']);

Route::get('/api/v1/categories', [CategoryController::class, 'index']);
Route::post('/api/v1/categories', [CategoryController::class, 'store']);
Route::delete('/api/v1/categories/{category:\d+}', [CategoryController::class, 'destroy']);

Route::get('/api/v1/products/{product:\d+}', [ProductController::class, 'show']);

Route::post('/api/v1/products/{product:\d+}/review', [ReviewController::class, 'store']);

