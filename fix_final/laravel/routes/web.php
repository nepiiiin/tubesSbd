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
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    $bestShotIds = Shot::orderByDesc('likes_count')
        ->get()
        ->groupBy('user_id')
        ->map(function ($shots) {
            return $shots->first()->id;
        });

    $shots = Shot::with(['user', 'categories'])
        ->whereIn('id', $bestShotIds)
        ->orderByDesc('likes_count')
        ->take(99)
        ->get()
        ->unique('image_url');

    $categories = Category::orderBy('id')->get();

    return view('welcome', compact('shots', 'categories'));

})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');


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
    
    $shots = \App\Models\Shot::where('user_id', $user->id)->get();

    return view('profile', compact('user', 'shots'));
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

    $bestShotIds = Shot::orderByDesc('likes_count')
        ->get()
        ->groupBy('user_id')
        ->map(function ($shots) {
            return $shots->first()->id;
        });

    $shots = Shot::with(['user', 'categories'])
        ->whereIn('id', $bestShotIds)
        ->orderByDesc('likes_count')
        ->take(99)
        ->get()
        ->unique('image_url');

    $categories = Category::orderBy('id')->get();

    return view('dashboard', compact('shots', 'categories'));

})->middleware(['auth'])->name('dashboard');

Route::get('/category/{name}', function ($name) {

    // discover bebas diakses
    if ($name !== 'discover' && !Auth::check()) {
        return redirect()->route('login');
    }

    $category = Category::where('name', $name)->firstOrFail();

    $shots = Shot::with(['user', 'categories'])
        ->whereHas('categories', function ($q) use ($name) {

            $q->where('name', $name);

        })
        ->latest()
        ->get();

    $categories = Category::orderBy('id')->get();

    // kalau belum login pakai welcome
    if (!Auth::check()) {
        return view('welcome', compact('shots', 'categories', 'category'));
    }

    return view('dashboard', compact('shots', 'categories', 'category'));

});

Route::get('/shots/{id}', function ($id) {

    $shot = Shot::with(['user', 'likes', 'categories'])
        ->findOrFail($id);

    return view('shot_details', compact('shot'));

})->name('shots.detail');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('admin/users', AdminUserController::class)->names('admin.users');

Route::middleware([IsAdmin::class])->group(function () {
    
    // Route Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Route CRUD Users
    Route::resource('admin/users', AdminUserController::class)->names('admin.users');

    // Nanti route Admin Shots buatan temenmu taruh di dalam sini juga ya!
    
});

// Route untuk nampilin form login
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Route untuk ngecek email & password
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('login.proses');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/shots/{shot}/like', function (\App\Models\Shot $shot) {

    $user = auth()->user();

    if (!$user) {

        return response()->json([
            'success' => false
        ], 401);

    }

    $existingLike = \App\Models\Like::where('user_id', $user->id)
        ->where('shot_id', $shot->id)
        ->first();

    // UNLIKE
    if ($existingLike) {

        $existingLike->delete();

        $shot->decrement('likes_count');

        return response()->json([
            'liked' => false,
            'likes' => $shot->fresh()->likes_count
        ]);

    }

    // LIKE
    \App\Models\Like::create([
        'user_id' => $user->id,
        'shot_id' => $shot->id
    ]);

    $shot->increment('likes_count');

    return response()->json([
        'liked' => true,
        'likes' => $shot->fresh()->likes_count
    ]);

})->middleware('auth')->name('shots.like');

require __DIR__.'/auth.php';
