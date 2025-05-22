<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingCalendar extends Model
{
    protected $table = 'booking_calendar';
    
    protected $fillable = [
        'kamar_id',
        'nama',
        'gender',
        'start_date',
        'end_date',
        'quantity'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'quantity' => 'integer'
    ];

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }

    public function getCampAttribute()
    {
        return $this->kamar?->camp;
    }
}
