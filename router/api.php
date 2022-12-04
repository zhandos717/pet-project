<?php

use App\Controllers\Api\ResultController;
use App\Core\Route;
use App\Http\Controllers\Api\V1\GoodController;

Route::get('/api/v1/goods', [GoodController::class, 'index']);
Route::get('/api/v1/goods/{good:\d+}', [GoodController::class, 'show']);
Route::put('/api/v1/goods/{good:\d+}', [GoodController::class, 'show']);
