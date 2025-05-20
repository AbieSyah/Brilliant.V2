<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kamar extends Model
{
    protected $table = 'kamar';
    
    protected $fillable = [
        'nama_kamar',
        'deskripsi'
    ];

    public function detailKamar(): HasOne
    {
        return $this->hasOne(DetailKamar::class);
    }
}
