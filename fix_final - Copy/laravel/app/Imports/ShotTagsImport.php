<?php

namespace App\Imports;

use App\Models\ShotTag;
use App\Models\Shot;
use App\Models\Tag;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShotTagsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $shotExists = Shot::where('id', $row['shot_id'])->exists();

        $tagExists = Tag::where('id', $row['tag_id'])->exists();

        if (!$shotExists || !$tagExists) {
            return null;
        }

        return new ShotTag([

            'shot_id' => $row['shot_id'],

            'tag_id' => $row['tag_id'],
        ]);
    }
}