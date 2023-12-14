<?php

namespace App\Exports;

use App\Models\Plant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PlantExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $plants = Plant::all(['nama_plant']);

        // Tambahkan nomor urut pada setiap baris data
        $numberedPlants = $plants->map(function ($plant, $index) {
            return [
                'No.' => $index + 1,
                'Nama Plant' => $plant->nama_plant,
                // ... (tambahkan kolom lain jika diperlukan)
            ];
        });

        return $numberedPlants;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Tentukan nama kolom (header) yang diinginkan
        return [
            'No.',
            'Nama Plant',
            // ... (tambahkan kolom lain jika diperlukan)
        ];
    }
    public function model(array $row)
    {
        return Plant::updateOrInsert(
            ['nama_plant' => $row['nama_plant']]
        );
    }
}
