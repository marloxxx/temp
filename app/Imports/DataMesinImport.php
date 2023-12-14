<?php

namespace App\Imports;

use App\Models\DataMesin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\KategoriMesin; // Ganti dengan model yang sesuai
use App\Models\KlasMesin; // Ganti dengan model yang sesuai

class DataMesinImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Identifikasi data berdasarkan kolom yang unik, misalnya 'kode_jenis'
        $uniqueColumn = 'kode_jenis';

        // Dapatkan ID kategori berdasarkan nama_kategori
        $kategori = KategoriMesin::firstOrCreate(['nama_kategori' => $row['nama_kategori']]);
        $kategoriId = $kategori->id;

        // Dapatkan ID klasifikasi berdasarkan klas_mesin
        $klasifikasi = KlasMesin::firstOrCreate(['nama_klasifikasi' => $row['klas_mesin']]);
        $klasifikasiId = $klasifikasi->id;

        // Update atau insert data mesin dengan kunci unik 'kode_jenis'
        $data = DataMesin::updateOrInsert(
            [$uniqueColumn => $row['kode_jenis']], // Kolom yang digunakan sebagai kunci unik
            [
                'nama_kategori' => $kategoriId,
                'klas_mesin' => $klasifikasiId,
                'nama_mesin' => $row['nama_mesin'],
                'type_mesin' => $row['type_mesin'],
                'merk_mesin' => $row['merk_mesin'],
                'gambar_mesin' => $row['gambar_mesin'],
                'spek_min' => $row['spek_min'],
                'spek_max' => $row['spek_max'],
                'pabrik' => $row['pabrik'],
                'kapasitas' => $row['kapasitas'],
                'tahun_mesin' => $row['tahun_mesin'],
                'lok_ws' => $row['lok_ws'],
            ]
        );
    }
}
