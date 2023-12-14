<?php

namespace App\Imports;

use App\Models\Plant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlantImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Identifikasi data berdasarkan kolom yang unik, misalnya 'kode_jenis'
        $uniqueColumn = 'nama_plant';

        // Update atau insert data mesin dengan kunci unik 'kode_jenis'
        $data = Plant::updateOrInsert(
            [$uniqueColumn => $row['nama_plant']], // Kolom yang digunakan sebagai kunci unik
        );
    }
}
