<?php

namespace App\Filament\Resources\Payments\Tables;

use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Users\UserResource;
use App\Models\Payment;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label(__('Payment time'))
                    ->sortable(),
                TextColumn::make('product.name')
                    ->label(__('Product name'))
                    ->url(fn (Payment $record) => ProductResource::getUrl('edit', ['record' => $record->product])),
                TextColumn::make('user.name')
                    ->label(__('User name'))
                    ->url(fn (Payment $record) => UserResource::getUrl('edit', ['record' => $record->user])),
                TextColumn::make('user.email')
                    ->label(__('User email')),
                TextColumn::make('voucher.code')
                    ->label(__('Code')),
                TextColumn::make('subtotal')
                    ->label(__('Subtotal'))
                    ->money('usd'),
                TextColumn::make('taxes')
                    ->label(__('Taxes'))
                    ->money('usd'),
                TextColumn::make('total')
                    ->label(__('Total'))
                    ->money('usd'),
            ])
            ->defaultSort('created_at', 'desc')
            ->contentFooter(view('filament.app.resources.payments.tables.footer'))
            ->filters([
                Filter::make('created_at')
                    ->schema([
                        DatePicker::make('created_from')
                            ->label(__('Created from')),
                        DatePicker::make('created_until')
                            ->label(__('Created until')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'],
                                fn(Builder $query) => $query->whereDate('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'],
                                fn(Builder $query) => $query->whereDate('created_at', '<=', $data['created_until']));
                    })
            ])
            ->recordActions([
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                ]),
            ]);
    }
}
