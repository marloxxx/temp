<?php

namespace Database\Seeders;

use App\Models\DataKategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DataAnggotaSeeder::class,
            UserSeeder::class,            
            DataKategoriSeeder::class,
            DataBukuSeeder::class,
            PeminjamanSeeder::class,
            
        ]);

    }
}
