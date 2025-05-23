<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Kamar;
use App\Models\BookingCalendar;
use Carbon\Carbon;

class BieplusWidget extends Widget
{
    protected static string $view = 'filament.widgets.bieplus-widget';
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 'full';

    public function getData(): array
    {
        $types = ['vip', 'vvip', 'barrack'];
        $data = [];

        foreach ($types as $type) {
            $rooms = Kamar::where('kategori', 'bieplus')
                         ->where('type_kamar', $type)
                         ->get();
                         
            $totalRooms = $rooms->count();
            
            if ($totalRooms > 0) {
                $occupiedRooms = BookingCalendar::whereIn('kamar_id', $rooms->pluck('id'))
                    ->where(function($query) {
                        $today = Carbon::now();
                        $query->where('start_date', '<=', $today)
                              ->where('end_date', '>=', $today);
                    })->count();

                $color = 'bg-green-500'; // Available
                if ($occupiedRooms > 0) {
                    $color = $occupiedRooms >= $totalRooms ? 'bg-red-500' : 'bg-amber-500';
                }

                $data[] = [
                    'type' => strtoupper($type),
                    'color' => $color,
                    'count' => "{$occupiedRooms}/{$totalRooms}",
                ];
            }
        }

        return $data;
    }
}
