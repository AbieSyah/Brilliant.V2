<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class StatusColorWidget extends Widget
{
    protected static string $view = 'filament.widgets.status-color-widget';
    protected static ?int $sort = 0; 
    protected int|string|array $columnSpan = 'full';
}
