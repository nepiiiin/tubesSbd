<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password',
        'avatar_url',
        'bio',
        'location',
        'website',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * RELATIONS
     */

    public function shots()
    {
        return $this->hasMany(Shot::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedShots()
    {
        return $this->belongsToMany(
            Shot::class,
            'likes',
            'user_id',
            'shot_id'
        );
    }

    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'follower_id',
            'following_id'
        );
    }

    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'following_id',
            'follower_id'
        );
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'poster_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'applicant_id');
    }
}