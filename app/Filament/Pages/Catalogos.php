<?php

namespace App\Filament\Pages;

use App\Livewire\CatalogosWidget;
use Filament\Pages\Page;

class Catalogos extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.catalogos';

    protected function getHeaderWidgets(): array
    {
        return [
            CatalogosWidget::class,
        ];
    }
}
