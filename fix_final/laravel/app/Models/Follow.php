<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public $timestamps = false;

    protected $table = 'follows';

    protected $fillable = [
        'follower_id',
        'following_id',
        'created_at',
    ];
}