<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    use HasFactory;
    protected $table = 'analisis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pelaporan_id',
        'pemohon_id',
        'petugas_id',
        'tanggal_analisa',
        'analisa',
        'tindakan',
        'saran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }
}
