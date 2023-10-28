<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestPayments extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getTableHeading(): string
    {
        return __('Latest Payments');
    }

    protected function getTableQuery(): Builder
    {
        return Payment::with('product')->latest()->take(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->label(__('Time')),
            Tables\Columns\TextColumn::make('total')
                ->label(__('Total'))
                ->money(),
            Tables\Columns\TextColumn::make('product.name')
                ->label(__('Product')),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
