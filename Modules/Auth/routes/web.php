<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
