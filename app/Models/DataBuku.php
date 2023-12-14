<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBuku extends Model
{

    use HasFactory;
    protected $table = 'data_bukus';
    protected $primaryKey = 'id';

    public function data_kategori()
    {
        return $this->belongsTo(DataKategori::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
    protected $fillable = [
        /*
       'judul_buku',
        'data_kategori_id',
        'book_image',
        'nama_pengarang' ,
        'penerbit',
        'tahun_terbit',
        'jumlah_halaman',
        'user_id',
        */
        'no_mesin',
        'nama_mesin',
        'data_kategori_id',
        'book_image',
        'spek',
        'jumlah',
        'user_id',
    ];
}
