<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class HomeOwnerImport implements ToCollection, WithStartRow
{
    /**
     * Skip the first row as this is merely the column title.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Returns import data as collection.
     *
     * @param Collection $collection
     * @return Collection
     */
    public function collection(Collection $collection)
    {
        return $collection;
    }
}
