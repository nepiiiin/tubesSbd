<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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
        // ⚠️ JANGAN masukkan 'created_at' dan 'updated_at' di sini!
        // Laravel menangani timestamps secara otomatis
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // 🔗 RELATIONS (Sesuai ERD)
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

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
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