<?php

namespace App\Filament\Resources\Vouchers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VouchersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__('Code')),
                TextColumn::make('discount_percent')
                    ->label(__('Discount (%)')),
                TextColumn::make('product.name')
                    ->label(__('Product name')),
                TextColumn::make('payments_count')
                    ->label(__('Times used'))
                    ->counts('payments'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                ]),
            ]);
    }
}
