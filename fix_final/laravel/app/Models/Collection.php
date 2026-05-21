<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    public function shots()
    {
        return $this->belongsToMany(
            Shot::class,
            'collection_items',
            'collection_id',
            'shot_id'
        )->withPivot('added_at');
    }
}