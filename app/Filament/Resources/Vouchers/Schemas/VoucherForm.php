<?php

namespace App\Filament\Resources\Vouchers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VoucherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label(__('Code'))
                    ->unique()
                    ->required(),
                TextInput::make('discount_percent')
                    ->label(__('Discount (%)'))
                    ->numeric()
                    ->default(10)
                    ->extraInputAttributes(['min' => 1, 'max' => 100, 'step' => 1]),
                Select::make('product_id')
                    ->label(__('Product'))
                    ->relationship('product', 'name')
            ]);
    }
}
