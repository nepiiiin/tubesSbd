<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shot;
use App\Models\User;

class Comment extends Model
{
    protected $fillable = [
        'shot_id',
        'user_id',
        'body',
        'created_at',
        'updated_at',
    ];
    public function shot()
{
    return $this->belongsTo(Shot::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}