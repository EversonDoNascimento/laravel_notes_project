<?php

use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/login", [AuthController::class, 'login'])->name('login');
Route::post("/loginSubmit", [AuthController::class, 'loginSubmit']);
Route::get("/logout", [AuthController::class, 'logout']);
