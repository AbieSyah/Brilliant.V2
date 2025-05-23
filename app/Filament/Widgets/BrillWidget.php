<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Camp;
use App\Models\Kamar;
use App\Models\BookingCalendar;
use Carbon\Carbon;

class BrillWidget extends Widget
{
    protected static string $view = 'filament.widgets.brill-widget';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function getCamps(): array
    {
        $camps = Camp::whereHas('kamar', function($query) {
            $query->where('kategori', 'brilliant');
        })->get();

        $campStatuses = [];

        foreach ($camps as $camp) {
            $brilliantRooms = $camp->kamar()
                ->where('kategori', 'brilliant')
                ->get();

            $hasActiveBooking = BookingCalendar::whereIn('kamar_id', $brilliantRooms->pluck('id'))
                ->where(function($query) {
                    $today = Carbon::now();
                    $query->where('start_date', '<=', $today)
                          ->where('end_date', '>=', $today);
                })->exists();

            $campStatuses[] = [
                'id' => $camp->id,
                'label' => $camp->nama_camp,
                'status' => $hasActiveBooking ? 'occupied' : 'available',
                'color' => $hasActiveBooking ? 'bg-red-500' : 'bg-green-500'
            ];
        }

        return $campStatuses;
    }
}
