<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::get('/', [PostController::class, 'index']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/for-designer', function () {
    return view('for-designer');
})->name('for.designer');

Route::resource('posts', PostController::class);