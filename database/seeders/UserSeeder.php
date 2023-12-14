<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'foto' => '/image/admin-male.png',
                'nama' => 'Muhamad Widyantoro',
                'email' => 'admin@admin.com',
                'password' => Hash::make('1234'),
                'level' => 'Admin',
                'tanggal_join' => '2022-06-04',
            ],
            [
                'foto' => '/image/admin-male.png',
                'nama' => 'Muhammad Rizki Mubarok',
                'email' => 'user@user.com',
                'password' => Hash::make('1234'),
                'level' => 'Admin',
                'tanggal_join' => '2022-06-04',
            ],
        ]);
    }
}
