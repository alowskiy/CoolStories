<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('registration', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('me', [AuthController::class, 'currentUser'])->middleware('auth:sanctum');
    Route::post('me', [AuthController::class, 'updateCurrentUser'])->middleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::resource('post', PostController::class)->middleware('auth:sanctum');

Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Error',
    ], status: 404);
});
