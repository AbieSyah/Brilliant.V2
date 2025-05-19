<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    protected $table = 'kamar';
    
    protected $fillable = [
        'nama_kamar',
        'deskripsi',
        'gender',
        'type_kamar',
        'kategori',
        'gambar',
        'harga'
    ];

    public function detailKamars(): HasMany
    {
        return $this->hasMany(DetailKamar::class);
    }
}
