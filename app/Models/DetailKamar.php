<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKamar extends Model
{
    protected $table = 'detail_kamar';

    protected $fillable = [
        'kamar_id',
        'alamat',
        'type_kamar',
        'kategori',
        'gender',
        'jumlah_kasur',
        'fasilitas',
        'peraturan',
        'gambar',
        'harga',
        'catatan_tambahan',
    ];

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }
}
