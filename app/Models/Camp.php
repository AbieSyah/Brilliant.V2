<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Camp extends Model
{
    protected $table = 'camp';
    
    protected $fillable = [
        'nama_camp',
        'deskripsi',
        'gambar_camp',
        'alamat',
        'jumlah_maksimal_kamar'
    ];

    public function kamar(): HasMany
    {
        return $this->hasMany(Kamar::class);
    }
}
