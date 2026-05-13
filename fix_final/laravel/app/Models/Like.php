<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;

    protected $table = 'likes';

    protected $fillable = [
        'shot_id',
        'user_id',
        'created_at',
    ];
}