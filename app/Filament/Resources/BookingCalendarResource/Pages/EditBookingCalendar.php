<?php

namespace App\Filament\Resources\BookingCalendarResource\Pages;

use App\Filament\Resources\BookingCalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookingCalendar extends EditRecord
{
    protected static string $resource = BookingCalendarResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
