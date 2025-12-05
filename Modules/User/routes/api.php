<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Api\UserController;

// All user API routes require authentication via Passport
Route::middleware('auth:api')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/export', [UserController::class, 'export']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});
