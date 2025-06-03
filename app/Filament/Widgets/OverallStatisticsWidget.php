<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Kamar;
use App\Models\BookingCalendar;
use Carbon\Carbon;

class OverallStatisticsWidget extends Widget
{
    protected static string $view = 'filament.widgets.overall-statistics-widget';
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 'full';

    public function getStatistics(): array
    {
        $categories = ['regular', 'regular+', 'homestay', 'homestay+', 'vip'];
        $statistics = [];
        $totalMembers = 0;

        foreach ($categories as $category) {
            // PERBAIKAN: Gunakan type_kamar dan filter kategori = 'brilliant'
            $totalRooms = Kamar::where('type_kamar', $category) // Ubah dari 'kategori' ke 'type_kamar'
                ->where('kategori', 'brilliant') // Tambahkan filter kategori = 'brilliant'
                ->count();
                
            $occupiedBeds = $this->getOccupiedBeds($category);
            
            $totalBeds = Kamar::where('type_kamar', $category) // Ubah dari 'kategori' ke 'type_kamar'
                ->where('kategori', 'brilliant') // Tambahkan filter kategori = 'brilliant'
                ->sum('jumlah_kasur');
            
            $statistics[$category] = [
                'occupied' => $occupiedBeds,
                'total' => $totalBeds,
                'percentage' => $totalBeds > 0 ? round(($occupiedBeds / $totalBeds) * 100) : 0,
                'color' => $this->getColorByCategory($category)
            ];

            $totalMembers += $occupiedBeds;
        }

        return [
            'categories' => $statistics,
            'totalMembers' => $totalMembers
        ];
    }

    private function getOccupiedBeds($category): int
    {
        $now = Carbon::now('Asia/Jakarta');
        
        // PERBAIKAN: Gunakan type_kamar dan filter kategori = 'brilliant'
        // Hitung berdasarkan count booking record, bukan sum quantity
        return BookingCalendar::whereHas('kamar', function($query) use ($category) {
                $query->where('type_kamar', $category) // Ubah dari 'kategori' ke 'type_kamar'
                      ->where('kategori', 'brilliant'); // Tambahkan filter kategori = 'brilliant'
            })
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->count(); // Menggunakan count() untuk konsistensi dengan BrillWidget
    }

    private function getColorByCategory($category): string
    {
        return match($category) {
            'regular' => '#3B82F6',      // Blue
            'regular+' => '#10B981',     // Green  
            'homestay' => '#F59E0B',     // Orange
            'homestay+' => '#EF4444',    // Red
            'vip' => '#8B5CF6',          // Purple
            default => '#6B7280'         // Gray
        };
    }
}
