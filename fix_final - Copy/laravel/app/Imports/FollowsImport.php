<?php

namespace App\Imports;

use App\Models\Follow;
use App\Models\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FollowsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $followerExists = User::where('id', $row['follower_id'])->exists();

        $followingExists = User::where('id', $row['following_id'])->exists();

        if (!$followerExists || !$followingExists) {
            return null;
        }

        return new Follow([

            'follower_id' => $row['follower_id'],

            'following_id' => $row['following_id'],

            'created_at' => $row['created_at'] ?? now(),
        ]);
    }
}