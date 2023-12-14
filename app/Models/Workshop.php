<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $table = 'workshop';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_workshop',
        'keterangan',
    ];

    public function datamesin()
    {
        return $this->hasMany(DataMesin::class);
    }
}
