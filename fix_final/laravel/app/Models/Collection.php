<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function shots()
{
    return $this->belongsToMany(
        Shot::class,
        'collection_items'
    )->withPivot('added_at');
}
}