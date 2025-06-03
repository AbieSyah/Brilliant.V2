<?php

namespace App\Filament\Resources\BookingCalendarResource\Pages;

use App\Filament\Resources\BookingCalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookingCalendars extends ListRecords
{
    protected static string $resource = BookingCalendarResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
