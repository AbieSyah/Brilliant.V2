<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingCalendar extends Model
{
    protected $table = 'booking_calendar';
    
    protected $fillable = [
        'kamar_id',
        'start_date',
        'end_date',
        'quantity'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }

    // Helper method to check availability
    public function isAvailable($startDate, $endDate): bool
    {
        return !static::where('kamar_id', $this->kamar_id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                          ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();
    }
}
