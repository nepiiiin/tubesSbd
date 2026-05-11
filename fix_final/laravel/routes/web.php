<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ShotsImport;
use App\Imports\CollectionsImport;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/discover', function () {
    return view('categories.discover');
});

Route::get('/animation', function () {
    return view('categories.animation');
});
Route::get('/branding', function () {
    return view('categories.branding');
});
Route::get('/illustration', function () {
    return view('categories.illustration');
});
Route::get('/mobile', function () {
    return view('categories.mobile');
});
Route::get('/print', function () {
    return view('categories.print');
});
Route::get('/product-design', function () {
    return view('categories.product-design');
});
Route::get('/typography', function () {
    return view('categories.typography');
});
Route::get('/web-design', function () {
    return view('categories.web-design');
});

Route::get('/profile/{username}', function ($username) {
   
    $user = \App\Models\User::where('username', $username)->firstOrFail();
    
    // $shots = \App\Models\Shot::where('user_id', $user->id)->get();

    // return view('profile', compact('user', 'shots'));
     return view('profile', compact('user'));
})->name('user.profile');

Route::get('/import-users', function () {

    Excel::import(new UsersImport, public_path('users.csv'));

    return 'Users Imported Successfully';

});
Route::get('/import-shots', function () {

    Excel::import(new ShotsImport, public_path('shots.csv'));

    return 'Shots Imported Successfully';
});
Route::get('/import-collections', function () {

    Excel::import(new CollectionsImport, public_path('collections.csv'));

    return 'Collections Imported Successfully';
});
require __DIR__.'/auth.php';
