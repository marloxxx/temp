<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataMesin;

class Pelaporan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function datamesin()
    {
        return $this->belongsTo(DataMesin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pemohon', 'id');
    }

    public function analisis()
    {
        return $this->belongsTo(Analisis::class, 'id', 'pelaporan_id');
    }

    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'id', 'pelaporan_id');
    }
}
