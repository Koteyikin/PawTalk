<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/profile', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index');
Route::post('/profile', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
