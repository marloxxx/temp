<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DataBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_bukus')->insert([
            [
                'no_mesin' => '847484748',
                'nama_mesin' => 'Naruto Shipuden Vol 30',
                'data_kategori_id' => '1',
                'book_image' => '',
                'spek' => 'p',
                'jumlah' => '2',
                'user_id' => 1,
            ],

        ]);
    }
}
