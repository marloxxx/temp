<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $fillable = [
        'user_id',
        'dari_tanggal',
        'ke_tanggal',
        'keterangan',
        'st_pengajuan',
        'nama_ws',
        'nama_alatmesink3',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
