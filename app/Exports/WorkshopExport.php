<?php

namespace App\Exports;

use App\Models\Workshop;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithUpserts;

class WorkshopExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $workshops = Workshop::all(['nama_workshop']);

        // Tambahkan nomor urut pada setiap baris data
        $numberedWorkshops = $workshops->map(function ($Workshop, $index) {
            return [
                'No.' => $index + 1,
                'Nama Workshop' => $Workshop->nama_workshop,
                // ... (tambahkan kolom lain jika diperlukan)
            ];
        });

        return $numberedWorkshops;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Tentukan nama kolom (header) yang diinginkan
        return [
            'No.',
            'Nama Workshop',
            // ... (tambahkan kolom lain jika diperlukan)
        ];
    }
    public function model(array $row)
    {
        return Workshop::updateOrInsert(
            ['nama_workshop' => $row['nama_workshop']]
        );
    }
}
