<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Panel;
use Filament\PanelProvider;

class FilamentServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('Welcome Admin !') // Remove Laravel text
            ->brandLogo(false) // Remove Filament logo
            ->colors([
                'primary' => Color::Amber,
                'secondary' => Color::Gray,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->navigationGroups([
                'Content Management',
                'System',
            ])
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->topNavigation(false);
    }
}