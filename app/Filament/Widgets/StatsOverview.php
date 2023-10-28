<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        return [
            Card::make('Payments this month',
                Payment::where('created_at', '>', now()->subDays(30))->count())
            ->label(__('Payments this month')),
            Card::make('Income this month', '$' .
                Payment::where('created_at', '>', now()->subDays(30))->sum('total'))
            ->label(__('Income this month')),
        ];
    }
}
