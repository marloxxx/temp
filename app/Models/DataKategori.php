<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKategori extends Model
{
    use HasFactory;

    protected $table = 'data_kategoris';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_kategori',
        'image',
        'deskripsi',
    ];

    public function data_bukus()
    {
        return $this->hasMany(DataBuku::class);
    }
}
