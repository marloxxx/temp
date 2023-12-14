<?php

namespace App\Imports;

use App\Models\Plant;
use Maatwebsite\Excel\Concerns\ToModel;

class KlasmesinImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Plant([
            //
        ]);
    }
}
