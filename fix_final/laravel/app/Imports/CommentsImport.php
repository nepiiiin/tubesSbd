<?php

namespace App\Imports;

use App\Models\Comment;
use App\Models\Shot;
use App\Models\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CommentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $shotExists = Shot::where('id', $row['shot_id'])->exists();

        $userExists = User::where('id', $row['user_id'])->exists();

        if (!$shotExists || !$userExists) {
            return null;
        }

        return new Comment([

            'shot_id' => $row['shot_id'],

            'user_id' => $row['user_id'],

            'body' => $row['body'],

            'created_at' => $row['created_at'] ?? now(),

            'updated_at' => $row['updated_at'] ?? now(),
        ]);
    }
}