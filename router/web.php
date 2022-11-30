<?php

use App\Controllers\Api\QuestionController;
use App\Controllers\Api\ResultController;
use App\Controllers\MainController;
use App\Core\Route;


Route::GET('/', [MainController::class, 'index']);
Route::POST('/result', [MainController::class, 'result']);


Route::GET('/api/questions', [QuestionController::class, 'index']);
Route::POST('/api/results', [ResultController::class, 'show']);

