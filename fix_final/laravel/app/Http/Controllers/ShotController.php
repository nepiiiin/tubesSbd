<?php

namespace App\Http\Controllers;

use App\Models\Shot;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShotController extends Controller
{
    /**
     * Tampilkan halaman home dengan shots terbaik
     */
    public function home()
    {
        $bestShotIds = Shot::withCount('likes')
            ->orderByDesc('likes_count')
            ->get()
            ->groupBy('user_id')
            ->map(function ($shots) {
                return $shots->first()->id;
            });

        $shots = Shot::with(['user', 'categories'])
            ->withCount('likes')
            ->whereIn('id', $bestShotIds)->inRandomOrder()
            ->take(99)
            ->get()
            ->unique('image_url');

        $categories = Category::orderBy('id')->get();

        return view('welcome', compact('shots', 'categories'));
    }

    /**
     * Tampilkan shots berdasarkan kategori
     */
    public function category($name)
    {
        // Discover bebas diakses, kategori lain harus login
        if ($name !== 'discover' && !Auth::check()) {
            return redirect()->route('login');
        }

        $category = Category::where('name', $name)->first();

        // Jika discover atau category tidak ditemukan, tampilkan semua
        if ($name === 'discover' || !$category) {
            $shots = Shot::with(['user', 'categories'])
                ->withCount('likes')
                ->inRandomOrder()
                ->paginate(12);
        } else {
            $shots = Shot::with(['user', 'categories'])
                ->withCount('likes')
                ->whereHas('categories', function ($q) use ($category) {
                    $q->where('id', $category->id);
                })
                ->inRandomOrder()
                ->paginate(12);
        }

        $categories = Category::orderBy('id')->get();

        // Tentukan view berdasarkan status login
        $view = Auth::check() ? 'dashboard' : 'welcome';

        return view($view, compact('shots', 'categories'));
    }

    /**
     * Search shots by title or author username
     */
    public function search(Request $request)
{
    $query = $request->input('q');

    $shots = Shot::with(['user', 'categories'])
        ->withCount('likes')
        ->where(function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
                ->orWhereHas('user', function ($q3) use ($query) {
                    $q3->where('username', 'LIKE', "%{$query}%");
                });
        })
        ->inRandomOrder()
        ->paginate(12);

    $categories = Category::orderBy('id')->get();

    return view('search', compact('shots', 'categories', 'query'));
}

    /**
     * Tampilkan detail shot
     */
    public function show($id)
    {
        $shot = Shot::with(['user', 'likes', 'categories'])
            ->findOrFail($id);

        return view('shot_details', compact('shot'));
    }

    /**
     * Return modal content untuk shot
     */
    public function modal($id)
    {
        $shot = Shot::with(['user', 'likes', 'categories'])
            ->withCount('likes')
            ->findOrFail($id);

        return view('partials.shot_modal_content', compact('shot'));
    }

    /**
     * Like/Unlike shot
     */
    public function like($id)
    {
        $shot = Shot::findOrFail($id);
        $user = auth()->user();

        $liked = $shot->likes()->where('user_id', $user->id)->exists();

        if ($liked) {
            $shot->likes()->detach($user->id);
        } else {
            $shot->likes()->attach($user->id);
        }

        return response()->json([
            'liked' => !$liked,
            'likes_count' => $shot->likes()->count()
        ]);
    }

    public function save($id)
{
    $user = auth()->user();
    $shot = Shot::findOrFail($id);

    $collection = $user->collections()->firstOrCreate(
        ['name' => 'Saved'],
        ['description' => 'My saved shots']
    );

    $alreadySaved = $collection->shots()
        ->where('shot_id', $shot->id)
        ->exists();

    if ($alreadySaved) {
        $collection->shots()->detach($shot->id);
    } else {
        $collection->shots()->attach($shot->id, [
            'added_at' => now()
        ]);
    }

    return response()->json([
        'saved' => !$alreadySaved
    ]);
}
}
