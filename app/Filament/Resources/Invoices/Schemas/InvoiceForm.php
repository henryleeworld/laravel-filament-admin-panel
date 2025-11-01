<?php

namespace App\Filament\Resources\Invoices\Schemas;

use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('invoice_number')
                                    ->label(__('Invoice number'))
                                    ->default('ABC-' . random_int(100000, 999999))
                                    ->required(),
                                DatePicker::make('invoice_date')
                                    ->label(__('Invoice date'))
                                    ->default(now())
                                    ->required(),
                            ])->columns([
                                'sm' => 2,
                            ]),
                        Section::make()
                            ->schema([
                                Placeholder::make('Products')
                                    ->label(__('Products')),
                                Repeater::make('invoiceItems')
                                    ->label(__('Invoice items'))
                                    ->relationship()
                                    ->schema([
                                        Select::make('product_id')
                                            ->label(__('Product'))
                                            ->options(Product::query()->pluck('name', 'id'))
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, Set $set) {
                                                $product = Product::find($state);
                                                if ($product) {
                                                    $set('price', number_format($product->price / 100, 2));
                                                    $set('product_price', $product->price);
                                                }
                                            })
                                            ->columnSpan([
                                                'md' => 5,
                                            ])
                                            ->required(),
                                        TextInput::make('product_amount')
                                            ->label(__('Product amount'))
                                            ->numeric()
                                            ->default(1)
                                            ->columnSpan([
                                                'md' => 2,
                                            ])
                                            ->required(),
                                        TextInput::make('price')
                                            ->label(__('Price'))
                                            ->disabled()
                                            ->dehydrated(false)
                                            ->numeric()
                                            ->columnSpan([
                                                'md' => 3,
                                            ]),
                                        Hidden::make('product_price'),
                                    ])
                                    ->defaultItems(1)
                                    ->columns([
                                        'md' => 10,
                                    ])
                                    ->columnSpan('full')
                            ]),
                    ])->columnSpan('full')
            ]);
    }
}
