<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table='pengembalians'; 
    protected $primaryKey = 'id'; 

    //untuk protect kolom id agar tidak diisi user
    protected $guarded = [
        'id',
    ];

    public function peminjaman(){
        return $this -> belongsTo(Peminjaman::class);
    }
}
