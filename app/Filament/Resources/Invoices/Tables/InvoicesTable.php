<?php

namespace App\Filament\Resources\Invoices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_date')
                    ->label(__('Invoice date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('invoice_number')
                    ->label(__('Invoice number'))
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label(__('Name'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
