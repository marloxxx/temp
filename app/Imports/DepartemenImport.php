<?php

namespace App\Imports;

use App\Models\Departemen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepartemenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Identifikasi data berdasarkan kolom yang unik, misalnya 'kode_jenis'
        $uniqueColumn = 'nama_departemen';

        // Update atau insert data mesin dengan kunci unik 'kode_jenis'
        $data = Departemen::updateOrInsert(
            [$uniqueColumn => $row['nama_departemen']], // Kolom yang digunakan sebagai kunci unik
        );
    }
}
