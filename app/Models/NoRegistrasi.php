<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoRegistrasi extends Model
{
    use HasFactory;

    protected $table = 'noregistrasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'kode_registrasi',
    ];

    public function datamesin()
    {
        return $this->hasMany(DataMesin::class);
    }
}
