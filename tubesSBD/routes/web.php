<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index']);

Route::view('/register', 'auth.register');

Route::view('/login', 'auth.login');

Route::get('/for-designer', function () {
    return view('for-designer');
})->name('for.designer');

Route::resource('posts', PostController::class);

Route::get('/posts/{post}', [PostController::class, 'show']);