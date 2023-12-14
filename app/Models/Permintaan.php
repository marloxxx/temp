<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'datamesin';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
    ];

    public function datamesin()
    {
        return $this->hasMany(DataMesin::class);
    }
}
