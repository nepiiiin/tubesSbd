<?php

namespace App\Imports;

use App\Models\Like;
use App\Models\Shot;
use App\Models\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LikesImport implements ToModel, WithHeadingRow
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

        return new Like([

            'shot_id' => $row['shot_id'],

            'user_id' => $row['user_id'],

            'created_at' => $row['created_at'] ?? now(),
        ]);
    }
}