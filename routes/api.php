<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('user', [CategoryController::class, 'index']);
// Route::post('user/store', [CategoryController::class, 'store']);
// Route::resource('/categories', CategoryController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/post', PostController::class);



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::delete('logout', [AuthController::class, 'logout']);
});
