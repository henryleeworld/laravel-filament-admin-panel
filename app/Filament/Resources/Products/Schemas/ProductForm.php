<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make(__('Main fields'))
                        ->schema([
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->reactive()
                                ->afterStateUpdated(function ($state, Set $set) {
                                    $set('slug', Str::slug($state, language: app()->getLocale()));
                                })
                                ->required(),
                            TextInput::make('slug')
                                ->label(__('Slug'))
                                ->required(),
                        ]),
                    Step::make(__('Secondary fields'))
                        ->schema([
                            TextInput::make('price')
                                ->label(__('Price'))
                                ->rule('numeric')
                                ->required(),
                            FileUpload::make('image')
                                ->label(__('Image')),
                        ]),
            ])
        ]);
    }
}
