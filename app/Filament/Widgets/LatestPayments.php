<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestPayments extends TableWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('Latest Payments'))
            ->paginated(false)
            ->query(fn (): Builder => Payment::with('product')->latest()->take(5))
            ->columns([
                TextColumn::make('created_at')
                    ->label(__('Time')),
                TextColumn::make('total')
                    ->label(__('Total'))
                    ->money(),
                TextColumn::make('product.name')
                    ->label(__('Product')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
