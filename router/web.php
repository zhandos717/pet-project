<?php

use App\Core\Route;
use App\Controllers\MainController;


Route::GET('/',[MainController::class, 'index']);
Route::GET('/result',[MainController::class, 'result']);

