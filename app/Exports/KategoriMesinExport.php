<?php

namespace App\Exports;

use App\Models\KategoriMesin;
use App\Models\Plant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KategoriMesinExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $kategoris = KategoriMesin::all(['nama_kategori', 'kode_kategori']);

        // Tambahkan nomor urut pada setiap baris data
        $numberedkategoris = $kategoris->map(function ($kategori, $index) {
            return [
                'No.' => $index + 1,
                'Nama Kategori' => $kategori->nama_kategori,
                'Kode Kategori' => $kategori->kode_kategori,
                // ... (tambahkan kolom lain jika diperlukan)
            ];
        });

        return $numberedkategoris;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Tentukan nama kolom (header) yang diinginkan
        return [
            'No.',
            'Nama Kategori',
            'Kode Kategori',
            // ... (tambahkan kolom lain jika diperlukan)
        ];
    }
    public function model(array $row)
    {
        return KategoriMesin::updateOrInsert(
            ['nama_kategori' => $row['nama_kategori']]
        );
    }
}
