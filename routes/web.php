<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckedIsLogged;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/login", [AuthController::class, 'login'])->name('login');
Route::post("/loginSubmit", [AuthController::class, 'loginSubmit']);

Route::middleware([CheckedIsLogged::class])->group(function () {
    Route::get("/logout", [AuthController::class, 'logout']);
    Route::get("/newNote", [MainController::class, 'newNote']);
    Route::get("/", [MainController::class, 'index']);
});
