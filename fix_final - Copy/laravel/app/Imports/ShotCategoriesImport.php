<?php

namespace App\Imports;

use App\Models\ShotCategory;
use App\Models\Shot;
use App\Models\Category;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShotCategoriesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $shotExists = Shot::where('id', $row['shot_id'])->exists();

        $categoryExists = Category::where('id', $row['category_id'])->exists();

        if (!$shotExists || !$categoryExists) {
            return null;
        }

        return new ShotCategory([

            'shot_id' => $row['shot_id'],

            'category_id' => $row['category_id'],
        ]);
    }
}