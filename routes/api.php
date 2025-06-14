<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TodoController;

// Endpoint untuk mendapatkan user yang sedang login
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Endpoint login (tanpa autentikasi)
Route::post('/login', [AuthController::class, 'login']);

// Group route yang membutuhkan autentikasi
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Endpoint search todo
    Route::get('/todos/search', [TodoController::class, 'search']);

    // CRUD routes untuk todos
    Route::apiResource('/todos', TodoController::class);
});
