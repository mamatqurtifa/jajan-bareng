<?php

namespace App\Filament\Resources\OrganizationResource\Widgets;

use App\Models\Organization;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrganizationCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Organizations', Organization::count())
                ->icon('heroicon-o-office-building')
                ->color('primary'),
        ];
    }
}

