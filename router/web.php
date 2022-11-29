<?php

use App\Controllers\Api\ResultController;
use App\Core\Route;
use App\Controllers\MainController;


Route::GET('/', [MainController::class, 'index']);
Route::POST('/result', [MainController::class, 'result']);
Route::POST('/api/results', [ResultController::class, 'store']);

