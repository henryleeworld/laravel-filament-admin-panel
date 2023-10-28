<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class About extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Other';

    protected static string $view = 'filament.pages.about';

    public function getTitle(): string
    {
        return __('About');
    }

    public static function getNavigationLabel(): string
    {
        return __('About');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Other');
    }
}
