<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shot extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_url',
        'title'
    ];

    /**
     * RELATIONS
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(
            User::class,
            'likes',
            'shot_id',
            'user_id'
        );
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'shot_categories',
            'shot_id',
            'category_id'
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * HELPERS
     */

    public function isLikedBy($user)
    {
        if (!$user) {
            return false;
        }

        return DB::table('likes')
            ->where('shot_id', $this->id)
            ->where('user_id', $user->id)
            ->exists();
    }

    public function isSavedBy($user)
    {
        if (!$user) {
            return false;
        }

        return DB::table('collection_items')
            ->join(
                'collections',
                'collection_items.collection_id',
                '=',
                'collections.id'
            )
            ->where('collection_items.shot_id', $this->id)
            ->where('collections.user_id', $user->id)
            ->exists();
    }

    public function isFollowedBy($user)
    {
        if (!$user) {
            return false;
        }

        return DB::table('follows')
            ->where('following_id', $this->user_id)
            ->where('follower_id', $user->id)
            ->exists();
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'image' => 'required|image',
    ]);

    $imagePath = $request->file('image')->store('shots', 'public');

    Shot::create([
        'user_id' => auth()->id(),

        'title' => $request->title,

        'description' => $request->description,

        'image_url' => $imagePath,

        'title' => $request->title,
    ]);

    return redirect('/profile/' . auth()->user()->username);
}
}