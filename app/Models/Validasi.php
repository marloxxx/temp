<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasFactory;
    protected $table = 'validasi';
    protected $fillable = [
        'user_id', 'pengajuan_id', 'action_to_do', 'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
