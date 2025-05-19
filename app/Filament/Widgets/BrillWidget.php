<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class BrillWidget extends Widget
{
    protected static string $view = 'filament.widgets.brill-widget';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function getCamps(): array
    {
        $camps = [];
        for ($i = 1; $i <= 65; $i++) {
            $camps[] = [
                'id' => $i,
                'status' => 'available',
                'label' => "camp {$i}"
            ];
        }
        return $camps;
    }
}
