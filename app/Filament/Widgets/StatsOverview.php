<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Reviews', Review::count())
                ->description('Total ulasan yang telah dibuat')
                ->descriptionIcon('heroicon-m-document-text')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->color('success'),
            // Add more stats as needed
        ];
    }
}
