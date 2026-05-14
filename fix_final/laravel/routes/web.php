<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ShotsImport;
use App\Imports\CollectionsImport;
use App\Imports\ShotTagsImport;
use App\Imports\TagsImport;
use App\Imports\ShotCategoriesImport;
use App\Imports\LikesImport;
use App\Imports\FollowsImport;
use App\Imports\CommentsImport;
use App\Imports\CollectionItemsImport;
use App\Imports\JobsImport;
use App\Imports\ApplicationsImport;
use App\Models\Shot;

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

Route::get('/import-shot-tags', function () {

    Excel::import(new ShotTagsImport, public_path('shot_tags.csv'));

    return 'Shot Tags Imported Successfully';
});

Route::get('/import-tags', function () {

    Excel::import(new TagsImport, public_path('tags.csv'));

    return 'Tags Imported Successfully';
});

Route::get('/import-shot-categories', function () {

    Excel::import(new ShotCategoriesImport, public_path('shot_categories.csv'));

    return 'Shot Categories Imported Successfully';
});
Route::get('/import-likes', function () {

    Excel::import(new LikesImport, public_path('likes.csv'));

    return 'Likes Imported Successfully';
});

Route::get('/import-follows', function () {

    Excel::import(new FollowsImport, public_path('follows.csv'));

    return 'Follows Imported Successfully';
});

Route::get('/import-comments', function () {

    Excel::import(new CommentsImport, public_path('comments.csv'));

    return 'Comments Imported Successfully';
});

Route::get('/import-collection-items', function () {

    Excel::import(new CollectionItemsImport, public_path('collection_items.csv'));

    return 'Collection Items Imported Successfully';
});

Route::get('/import-jobs', function () {

    Excel::import(new JobsImport, public_path('jobs.csv'));

    return 'Jobs Imported Successfully';
});

Route::get('/import-applications', function () {

    Excel::import(new ApplicationsImport, public_path('applications.csv'));

    return 'Applications Imported Successfully';
});

Route::get('/dashboard', function () {

    $shots = Shot::with(['user', 'likes'])
        ->latest()
        ->paginate(20);

    return view('dashboard', compact('shots'));

})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';
