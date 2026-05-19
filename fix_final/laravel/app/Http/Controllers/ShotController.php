<?php

namespace App\Http\Controllers;

use App\Models\Shot;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShotController extends Controller
{
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
            ->whereIn('id', $bestShotIds)
            ->inRandomOrder()
            ->take(99)
            ->get()
            ->unique('image_url');

        $categories = Category::orderBy('id')->get();
        return view('welcome', compact('shots', 'categories'));
    }

    public function category($name)
    {
        if ($name !== 'discover' && !Auth::check()) {
            return redirect()->route('login');
        }

        $category = Category::where('name', $name)->first();

        if ($name === 'discover' || !$category) {
            $shots = Shot::with(['user', 'categories'])->withCount('likes')->inRandomOrder()->paginate(12);
        } else {
            $shots = Shot::with(['user', 'categories'])->withCount('likes')
                ->whereHas('categories', function ($q) use ($category) {
                    $q->where('id', $category->id);
                })
                ->inRandomOrder()->paginate(12);
        }

        $categories = Category::orderBy('id')->get();
        $view = Auth::check() ? 'dashboard' : 'welcome';
        return view($view, compact('shots', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $shots = Shot::with(['user', 'categories'])->withCount('likes')
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhereHas('user', function ($q3) use ($query) {
                        $q3->where('username', 'LIKE', "%{$query}%");
                    });
            })
            ->inRandomOrder()->paginate(12);

        $categories = Category::orderBy('id')->get();
        $view = Auth::check() ? 'dashboard' : 'welcome';
        return view($view, compact('shots', 'categories'));
    }

    public function show($id)
    {
        $shot = Shot::with(['user', 'likes', 'categories', 'comments'])->withCount(['likes', 'comments'])->findOrFail($id);
        return view('shot_details', compact('shot'));
    }

    public function modal($id)
    {
        $shot = Shot::with(['user', 'likes', 'categories'])->withCount('likes')->findOrFail($id);
        return view('partials.shot_modal_content', compact('shot'));
    }

    public function like(Shot $shot)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $existingLike = Like::where('user_id', $user->id)->where('shot_id', $shot->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['liked' => false, 'likes' => $shot->likes()->count()]);
        }

        Like::create(['user_id' => $user->id, 'shot_id' => $shot->id]);
        return response()->json(['liked' => true, 'likes' => $shot->likes()->count()]);
    }

    public function save(Shot $shot)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $existing = DB::table('collection_items')
            ->join('collections', 'collection_items.collection_id', '=', 'collections.id')
            ->where('collection_items.shot_id', $shot->id)
            ->where('collections.user_id', $user->id)
            ->first();

        if ($existing) {
            DB::table('collection_items')->where('id', $existing->id)->delete();
            return response()->json(['saved' => false]);
        }

        $collection = DB::table('collections')->where('user_id', $user->id)->where('name', 'Saved Shots')->first();
        if (!$collection) {
            $collectionId = DB::table('collections')->insertGetId([
                'user_id' => $user->id,
                'name' => 'Saved Shots',
                'description' => 'Auto-generated',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $collectionId = $collection->id;
        }

        DB::table('collection_items')->insert([
            'collection_id' => $collectionId,
            'shot_id' => $shot->id,
            'added_at' => now()
        ]);
        return response()->json(['saved' => true]);
    }
}