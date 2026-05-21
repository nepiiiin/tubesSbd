<?php

namespace App\Http\Controllers;

use App\Models\Shot;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;

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

            $shots = Shot::with(['user', 'categories'])
                ->withCount('likes')
                ->inRandomOrder()
                ->get();

        } else {

            $shots = Shot::with(['user', 'categories'])
                ->withCount('likes')
                ->whereHas('categories', function ($q) use ($category) {
                    $q->where('id', $category->id);
                })
                ->inRandomOrder()
                ->get();
        }

        $categories = Category::orderBy('id')->get();

        $view = Auth::check()
            ? 'dashboard'
            : 'welcome';

        return view($view, compact('shots', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $shots = Shot::with(['user', 'categories'])
            ->withCount('likes')
            ->where(function ($q) use ($query) {

                $q->where(
                    'title',
                    'LIKE',
                    "%{$query}%"
                )

                ->orWhereHas('user', function ($q3) use ($query) {

                    $q3->where(
                        'username',
                        'LIKE',
                        "%{$query}%"
                    );
                });
            })

            ->get();

        $categories = Category::orderBy('id')->get();

        return view(
            'search',
            compact('shots', 'categories', 'query')
        );
    }

    public function show($id)
{
    $shot = Shot::with([
        'user',
        'likes',
        'categories',
        'comments.user'
    ])
    ->withCount('likes')
    ->findOrFail($id);

    return view('shot_details', compact('shot'));
}

    public function modal($id)
{
    $shot = Shot::with([
        'user',
        'likes',
        'categories',
        'comments.user'
    ])
    ->withCount('likes')
    ->findOrFail($id);

    return view(
        'partials.shot_modal_content',
        compact('shot')
    );
}

    public function like($id)
    {
        $shot = Shot::findOrFail($id);

    $user = auth()->user();

        if (!$user) {
        return response()->json([
            'message' => 'Unauthenticated'
        ], 401);
    }

    $liked = $shot->likes()
        ->where('user_id', $user->id)
        ->exists();

    if ($liked) {
        $shot->likes()->detach($user->id);
    } else {
        $shot->likes()->attach($user->id);
    }

    $likesCount = $shot->likes()->count();

    return response()->json([
        'liked' => !$liked,
        'likes_count' => $likesCount
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
    public function destroy($id)
{
    $shot = Shot::findOrFail($id);

    if($shot->user_id !== auth()->id()){
        abort(403);
    }

    if($shot->image_url){

        \Storage::disk('public')
            ->delete($shot->image_url);
    }

    $shot->likes()->detach();

    $shot->delete();

    return redirect('/profile/' . auth()->user()->username);
}

public function comment(Request $request, $id)
{
    $request->validate([
        'body' => ['required', 'string', 'max:1000'],
    ]);

    $shot = Shot::findOrFail($id);

    $comment = Comment::create([
        'shot_id' => $shot->id,
        'user_id' => auth()->id(),
        'body' => $request->body,
    ]);

    $comment->load('user');

    return response()->json([
        'success' => true,
        'comment' => [
            'id' => $comment->id,
            'body' => $comment->body,
            'user' => [
                'username' => $comment->user->username,
                'avatar_url' => $comment->user->avatar_url,
            ],
            'created_at' => $comment->created_at->diffForHumans(),
        ],
    ]);
}
}