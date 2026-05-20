<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShotController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Imports\UsersImport;
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
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', [ShotController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', function () {
    return view('register');
})->name('register');

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

Route::get('/category/{name}', [ShotController::class, 'category'])->name('category');
Route::get('/search', [ShotController::class, 'search'])->name('search');

Route::get('/shots/{id}', [ShotController::class, 'show'])->name('shots.detail');
Route::get('/shots/{id}/modal', [ShotController::class, 'modal'])->name('shots.modal');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/shots/{id}/save', [ShotController::class, 'save'])
    ->middleware('auth');
    Route::post('/users/{id}/follow', [UserController::class, 'follow'])
    ->middleware('auth');
    Route::post('/shots/{id}/like', [ShotController::class, 'like'])
    ->middleware('auth');
    
    Route::get('/profile/{username}/{tab?}', function ($username, $tab = 'work') {

    $user = \App\Models\User::where(
        'username',
        $username
    )->firstOrFail();

    if ($tab === 'liked') {

    $likedIds = $user->likedShots()
        ->pluck('shots.id');

    $bestShotIds = \App\Models\Shot::withCount('likes')
        ->whereIn('id', $likedIds)
        ->orderByDesc('likes_count')
        ->get()
        ->groupBy('user_id')
        ->map(function ($shots) {

            return $shots->first()->id;
        });

    $shots = \App\Models\Shot::with([
            'user',
            'categories'
        ])
        ->withCount('likes')
        ->whereIn('id', $bestShotIds)
        ->inRandomOrder()
        ->get();

} else {

        $shots = \App\Models\Shot::where(
            'user_id',
            $user->id
        )
        ->with(['user', 'categories'])
        ->withCount('likes')
        ->latest()
        ->get();
    }

    $collections = [];

    if ($tab === 'collections') {

        $collections = \App\Models\Collection::where(
            'user_id',
            $user->id
        )->get();
    }

    return view(
        'profile',
        compact(
            'user',
            'shots',
            'collections',
            'tab'
        )
    );

})->name('user.profile');

    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    
    Route::get('/jobs/{job}/applications', [ApplicationController::class, 'jobApplications'])
        ->name('jobs.applications');
    
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])
        ->name('applications.update-status');
    
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
        ->name('jobs.apply');
    
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])
        ->name('applications.my');
});

Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('admin/users', AdminUserController::class)->names('admin.users');
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
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
    $bestShotIds = \App\Models\Shot::withCount('likes')
        ->orderByDesc('likes_count')
        ->get()
        ->groupBy('user_id')
        ->map(function ($shots) {
            return $shots->first()->id;
        });

    $shots = \App\Models\Shot::with(['user', 'categories'])
    ->withCount('likes')
    ->whereIn('id', $bestShotIds)
    ->inRandomOrder()
    ->paginate(12);

    $categories = \App\Models\Category::orderBy('id')->get();

    return view('dashboard', compact('shots', 'categories'));
})->middleware(['auth'])->name('dashboard');

use App\Http\Controllers\PostController;

Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create');
    Route::post('/shots', [PostController::class, 'store'])
    ->name('shots.store');

    Route::get('/shots/{shot}', [ShotController::class, 'show'])
    ->name('shots.show');
   
    Route::delete(
    '/shots/{id}',
    [ShotController::class, 'destroy']
    
)->name('shots.destroy');


require __DIR__.'/auth.php';