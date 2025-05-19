<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailKamar extends Model
{
    protected $table = 'detail_kamar';
    
    protected $fillable = [
        'kamar_id',
        'nama_detail',
        'jumlah_kasur',
        'fasilitas',
        'peraturan'
    ];

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(BookingCalendar::class);
    }
}
