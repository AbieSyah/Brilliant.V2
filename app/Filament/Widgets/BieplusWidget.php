<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class BieplusWidget extends Widget
{
    protected static string $view = 'filament.widgets.bieplus-widget';
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 'full';

    public function getData(): array
    {
        return [
            [
                'type' => 'vvip',
                'color' => 'bg-green-500',
                'count' => '0/98',
            ],
            [
                'type' => 'vip',
                'color' => 'bg-amber-500',
                'count' => '15/98',
            ],
            [
                'type' => 'Barrack',
                'color' => 'bg-red-500',
                'count' => '12orang',
            ],
        ];
    }
}
