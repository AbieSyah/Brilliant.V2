<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    protected $table = 'kamar';

    protected $fillable = [
        'camp_id',
        'nama_kamar',
        'type_kamar',
        'kategori',
        'gender',
        'jumlah_kasur',
        'fasilitas',
        'peraturan',
        'gambar',
        'harga',
        'catatan_tambahan'
    ];

    protected $casts = [
        'harga' => 'decimal:2'
    ];

    public function camp(): BelongsTo
    {
        return $this->belongsTo(Camp::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(BookingCalendar::class);
    }
}
