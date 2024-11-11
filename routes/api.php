<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('user', [CategoryController::class, 'index']);
// Route::post('user/store', [CategoryController::class, 'store']);
// Route::resource('/categories', CategoryController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/post', PostController::class);
