<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMesin extends Model
{

    use HasFactory;
    protected $table = 'kategorimesin';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_kategori',
        'kode_kategori',
    ];

    public function generateUniqueKodeJenis()
    {
        $countByKategori = $this->dataMesin()->count();

        // Menghasilkan kode jenis yang unik berdasarkan kode kategori dan jumlah data
        return str_pad($this->kode_kategori, 3, '0', STR_PAD_LEFT) . '-' . str_pad($countByKategori + 1, 3, '0', STR_PAD_LEFT);
    }

    public function dataMesin()
    {
        return $this->hasMany(DataMesin::class, 'nama_kategori', 'id');
    }

    public function getKategoriData()
    {
        $kategoriData = KategoriMesin::all();
        return response()->json($kategoriData);
    }
    public static function hitungJumlahkategori()
    {
        return KategoriMesin::select('nama_kategori', DB::raw('count(*) as jumlah'))
            ->groupBy('nama_kategori')
            ->get();
    }
    public function getLatestNomorUrut()
    {
        return static::max('nomor_urut') + 1;
    }

    // Fungsi untuk menginkrementasi nomor urut
    public function incrementNomorUrut()
    {
        $this->update(['nomor_urut' => $this->getLatestNomorUrut()]);
    }
}
