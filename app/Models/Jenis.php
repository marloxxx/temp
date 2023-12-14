<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';

    // Mendefinisikan peristiwa "creating" untuk menghasilkan kode
    public static function boot()
    {
        parent::boot();

        static::creating(function ($jenis) {
            $latestJenis = Jenis::latest()->first();

            if ($latestJenis) {
                $latestKode = $latestJenis->kodeJenis;
                $newKode = str_pad((int) $latestKode + 1, strlen($latestKode), '0', STR_PAD_LEFT);
            } else {
                $newKode = '001'; // Jika belum ada data
            }

            $jenis->kodeJenis = $newKode;
        });
    }
}
