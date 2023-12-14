<?php

namespace App\Exports;

use App\Models\DataMesin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataMesinExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return DataMesin::with(['kategori', 'klasifikasi'])
            ->select('kode_jenis', 'nama_kategori', 'klas_mesin', 'nama_mesin', 'type_mesin', 'merk_mesin', 'gambar_mesin', 'spek_min', 'spek_max', 'pabrik', 'kapasitas', 'tahun_mesin', 'lok_ws', 'created_at', 'updated_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'kode_jenis',
            'nama_kategori',
            'klas_mesin',
            'nama_mesin',
            'type_mesin',
            'merk_mesin',
            'gambar_mesin',
            'spek_min',
            'spek_max',
            'pabrik',
            'kapasitas',
            'tahun_mesin',
            'lok_ws',
            'created_at',
            'updated_at',
        ];
    }

    public function map($mesin): array
    {
        return [
            $mesin->kode_jenis,
            $mesin->kategori->nama_kategori,
            $mesin->klasifikasi->nama_klasifikasi,
            $mesin->nama_mesin,
            $mesin->type_mesin,
            $mesin->merk_mesin,
            $mesin->gambar_mesin,
            $mesin->spek_min,
            $mesin->spek_max,
            $mesin->pabrik,
            $mesin->kapasitas,
            $mesin->tahun_mesin,
            $mesin->lok_ws,
            $mesin->created_at,
            $mesin->updated_at,
        ];
    }
}
