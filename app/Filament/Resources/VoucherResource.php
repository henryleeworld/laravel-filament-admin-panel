<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherResource\Pages;
use App\Filament\Resources\VoucherResource\RelationManagers;
use App\Models\Voucher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label(__('Code'))
                    ->required()
                    ->unique(),
                Forms\Components\TextInput::make('discount_percent')
                    ->label(__('Discount (%)'))
                    ->numeric()
                    ->default(10)
                    ->extraInputAttributes(['min' => 1, 'max' => 100, 'step' => 1]),
                Forms\Components\Select::make('product_id')
                    ->label(__('Product'))
                    ->relationship('product', 'name')
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('voucher');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Shop');
    }

    public static function getNavigationLabel(): string
    {
        return __('Voucher');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVouchers::route('/'),
//            'create' => Pages\CreateVoucher::route('/create'),
//            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label(__('Code')),
                Tables\Columns\TextColumn::make('discount_percent')
                    ->label(__('Discount (%)')),
                Tables\Columns\TextColumn::make('product.name')
                    ->label(__('Product name')),
                Tables\Columns\TextColumn::make('payments_count')
                    ->label(__('Times used'))
                    ->counts('payments'),
            ])
            ->filters([
                //
            ]);
    }
}
