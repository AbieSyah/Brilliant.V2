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

            $totalStatus = $this->calculateCampStatus($brilliantRooms);

            $campStatuses[] = [
                'id' => $camp->id,
                'label' => $camp->nama_camp,
                'status' => $totalStatus['status'],
                'color' => $totalStatus['color'],
                'bookingInfo' => $totalStatus['bookingInfo']
            ];
        }

        return $campStatuses;
    }

    private function calculateCampStatus($rooms)
    {
        $today = Carbon::now();
        $totalBeds = 0;
        $occupiedBeds = 0;

        foreach ($rooms as $room) {
            $totalBeds += $room->jumlah_kasur;
            
            $roomBookings = BookingCalendar::where('kamar_id', $room->id)
                ->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)
                ->count();
                
            $occupiedBeds += $roomBookings;
        }

        $color = 'bg-green-500'; // Available (hijau)
        if ($occupiedBeds > 0) {
            $color = $occupiedBeds >= $totalBeds ? 'bg-red-500' : 'bg-amber-500'; // Kuning jika ada booking tapi belum penuh
        }

        return [
            'status' => $occupiedBeds == 0 ? 'available' : ($occupiedBeds >= $totalBeds ? 'full' : 'partially_occupied'),
            'color' => $color,
            'bookingInfo' => "$occupiedBeds/$totalBeds"
        ];
    }
}
