<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('payment');
    }

    public static function getNavigationGroup(): ?string
    {
        return __(static::$navigationGroup);
    }

    public static function getNavigationLabel(): string
    {
        return __('Payment');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Payment time'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label(__('Product name'))
                    ->url(fn (Payment $record) => ProductResource::getUrl('edit', ['record' => $record->product])),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User name'))
                    ->url(fn (Payment $record) => UserResource::getUrl('edit', ['record' => $record->user])),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('User email')),
                Tables\Columns\TextColumn::make('voucher.code')
                    ->label(__('Code')),
                Tables\Columns\TextColumn::make('subtotal')
                    ->label(__('Subtotal'))
                    ->money('usd'),
                Tables\Columns\TextColumn::make('taxes')
                    ->label(__('Taxes'))
                    ->money('usd'),
                Tables\Columns\TextColumn::make('total')
                    ->label(__('Total'))
                    ->money('usd'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label(__('Created from')),
                        Forms\Components\DatePicker::make('created_until')
                            ->label(__('Created until')),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'],
                                fn($query) => $query->whereDate('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'],
                                fn($query) => $query->whereDate('created_at', '<=', $data['created_until']));
                    })
            ]);
    }
}
