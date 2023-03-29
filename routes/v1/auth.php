<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UpdatePasswordController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');
Route::post('/password-reset', UpdatePasswordController::class)->name('password-reset');
Route::post('/forgot-password', ForgotPasswordController::class)->name('forgot-password');
