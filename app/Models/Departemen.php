<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_departemen',
    ];

    public function datamesin()
    {
        return $this->hasMany(DataMesin::class);
    }
}
