<?php

namespace App\Imports;

use App\Models\CollectionItem;
use App\Models\Collection;
use App\Models\Shot;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CollectionItemsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $collectionExists = Collection::where('id', $row['collection_id'])->exists();

        $shotExists = Shot::where('id', $row['shot_id'])->exists();

        if (!$collectionExists || !$shotExists) {
            return null;
        }

        return new CollectionItem([

            'collection_id' => $row['collection_id'],

            'shot_id' => $row['shot_id'],

            'added_at' => $row['added_at'] ?? now(),
        ]);
    }
}