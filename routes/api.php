<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('roles', RolController::class);
Route::apiResource('categories', CategoryController::class);