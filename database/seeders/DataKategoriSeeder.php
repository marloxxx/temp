<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class DataKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_kategoris')->insert([
            [
                'nama_kategori' => 'mesin 1',
                'deskripsi' => 'Komik merupakan cerita yang menonjolkan pada gambar statis yang ditampilkan sesuai urutan peristiwa.',
            ],
            [
                'nama_kategori' => 'mesin 2',
                'deskripsi' => 'Suatu buku yang menceritakan tentang rangkaian kehidupan seorang tokoh dan orang-orang
                             disekitarnya dengan berbagai macam watak yang ditonjolkan',
            ],
        ]);
    }
}
