<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckedIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

// Routes user is not logged
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get("/login", [AuthController::class, 'login'])->name('login');
    Route::post("/loginSubmit", [AuthController::class, 'loginSubmit']);
    
});

// Routes user is logged
Route::middleware([CheckedIsLogged::class])->group(function () {
    Route::get("/logout", [AuthController::class, 'logout'])->name('logout');
    Route::get("/newNote", [MainController::class, 'newNote'])->name('new');
    Route::get("/", [MainController::class, 'index'])->name('home');
});
