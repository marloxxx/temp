<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $table = 'plant';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_plant',
    ];

    public function datamesin()
    {
        return $this->hasMany(DataMesin::class);
    }
}
