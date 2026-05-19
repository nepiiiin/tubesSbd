<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    // Kalau tabel likes pakai created_at/updated_at, set true
    public $timestamps = true;

    protected $table = 'likes';

    // Hanya kolom data, bukan timestamps
    protected $fillable = [
        'user_id',
        'shot_id',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Shot
    public function shot(): BelongsTo
    {
        return $this->belongsTo(Shot::class);
    }
}