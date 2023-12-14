<?php

namespace App\Exports;

use App\Models\Departemen;
use App\Models\Plant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithUpserts;

class DepartemenExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $plants = Departemen::all(['nama_departemen']);

        // Tambahkan nomor urut pada setiap baris data
        $numberedPdepartemens = $plants->map(function ($departemen, $index) {
            return [
                'No.' => $index + 1,
                'Nama Departemen' => $departemen->nama_departemen,
                // ... (tambahkan kolom lain jika diperlukan)
            ];
        });

        return $numberedPdepartemens;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Tentukan nama kolom (header) yang diinginkan
        return [
            'No.',
            'Nama Departemen',
            // ... (tambahkan kolom lain jika diperlukan)
        ];
    }
    public function model(array $row)
    {
        return Plant::updateOrInsert(
            ['nama_departemen' => $row['nama_departemen']]
        );
    }
}
