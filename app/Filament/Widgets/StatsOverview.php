<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Payments this month',
                Payment::where('created_at', '>', now()->subDays(30))->count())
                ->label(__('Payments this month')),
            Stat::make('Income this month', '$' .
                Payment::where('created_at', '>', now()->subDays(30))->sum('total'))
                ->label(__('Income this month')),
        ];
    }
}
