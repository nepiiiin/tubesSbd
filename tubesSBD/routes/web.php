<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/register', 'auth.register');
Route::view('/login', 'auth.login');

Route::get('/for-designer', function () {
    return view('for-designer'); // Merujuk ke file for-designer.blade.php
})->name('for.designer'); // <--- PENTING: Ini memberi nama pada route