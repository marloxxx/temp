<?php

namespace App\Exports;

use App\Models\KlasMesin;
use App\Models\KategoriMesin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithMapping;

class KlasMesinExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $KlasMesins = KlasMesin::all(['nama_klasifikasi', 'kode_klasifikasi', 'kategorimesin_id']);

        // Tambahkan nomor urut pada setiap baris data
        $numberedKlasMesins = $KlasMesins->map(function ($KlasMesin, $index) {
            // Dapatkan nama kategori berdasarkan kategorimesin_id
            $kategoriNama = KategoriMesin::find($KlasMesin->kategorimesin_id)->nama_kategori;

            return [
                'No.' => $index + 1,
                'Kategori' => $kategoriNama,
                'Nama Klasifikasi' => $KlasMesin->nama_klasifikasi,
                'Kode Klasifikasi' => $KlasMesin->kode_klasifikasi,
                // ... (tambahkan kolom lain jika diperlukan)
            ];
        });

        return $numberedKlasMesins;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Tentukan nama kolom (header) yang diinginkan
        return [
            'No.',
            'Kategori',
            'Nama Klasifikasi',
            'Kode Klasifikasi',
            // ... (tambahkan kolom lain jika diperlukan)
        ];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        // Kembalikan baris data yang di-mapping
        return [
            $row['No.'],
            $row['Kategori'],
            $row['Nama Klasifikasi'],
            $row['Kode Klasifikasi'],
            // ... (tambahkan kolom lain jika diperlukan)
        ];
    }
}
