<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KlasMesin extends Model
{
    use HasFactory;

    protected $table = 'klasmesin';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_klasifikasi',
        'kode_klasifikasi',
        "kategorimesin_id",
    ];

    public function datamesin()
    {
        return $this->hasMany(DataMesin::class);
    }

    public static function hitungJumlahKlasifikasi()
    {
        return KlasMesin::select('nama_klasifikasi', DB::raw('count(*) as jumlah'))
            ->groupBy('nama_kasifikasi')
            ->get();
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriMesin::class, 'nama_kategori', 'id');
    }
}
