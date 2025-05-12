<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use App\Models\Facility;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Reviews', Review::count())
                ->description('Total ulasan yang telah dibuat')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->color('success'),

            Stat::make('Total Kamar', Facility::count())
                ->description('Semua tipe kamar')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Kamar Brilliant', Facility::where('kategori', 'brilliant')->count())
                ->description('Kategori Brilliant')
                ->color('info')
                ->chart([4, 5, 3, 4, 5, 3, 5, 4]),

            Stat::make('Kamar Bieplus', Facility::where('kategori', 'bieplus')->count())
                ->description('Kategori Bieplus')
                ->color('info')
                ->chart([2, 3, 4, 3, 4, 5, 4, 3]),

            Stat::make('Regular', Facility::where('tipe_kamar', 'regular')->count())
                ->description('Tipe Regular')
                ->color('danger')
                ->chart([3, 5, 4, 3, 5, 4, 3, 5]),

            Stat::make('Regular+', Facility::where('tipe_kamar', 'regular+')->count())
                ->description('Tipe Regular Plus')
                ->color('primary')
                ->chart([4, 3, 5, 4, 3, 5, 4, 3]),

            Stat::make('VIP', Facility::where('tipe_kamar', 'vip')->count())
                ->description('Tipe VIP')
                ->color('warning')
                ->chart([5, 4, 3, 5, 4, 3, 5, 4]),

            Stat::make('VVIP', Facility::where('tipe_kamar', 'vvip')->count())
                ->description('Tipe VVIP')
                ->color('success')
                ->chart([4, 5, 3, 4, 5, 3, 5, 4]),

            Stat::make('Homestay', Facility::where('tipe_kamar', 'homestay')->count())
                ->description('Tipe Homestay')
                ->color('info')
                ->chart([3, 4, 5, 3, 4, 5, 3, 4]),

            Stat::make('Homestay+', Facility::where('tipe_kamar', 'homestay+')->count())
                ->description('Tipe Homestay Plus')
                ->color('primary')
                ->chart([5, 3, 4, 5, 3, 4, 5, 3]),

            Stat::make('Barak', Facility::where('tipe_kamar', 'barak')->count())
                ->description('Tipe Barak')
                ->color('danger')
                ->chart([4, 3, 5, 4, 3, 5, 4, 3]),
        ];

    }
}
