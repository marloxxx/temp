<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    
    protected $table='peminjaman'; 
    protected $primaryKey = 'id'; 

    //untuk protect kolom id agar tidak diisi user
    protected $guarded = [
        'id',
    ];

    public function buku(){
        return $this ->belongsTo(DataBuku::class,'bukus_id');
    }
    public function anggota(){
        return $this -> belongsTo(DataAnggota::class,'anggotas_id');
    }
    public function user(){
        return $this -> belongsTo(User::class);
    }
    public function pengembalian(){
        return $this -> hasOne(Pengembalian::class);
    }
}
