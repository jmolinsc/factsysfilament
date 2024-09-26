<?php

namespace App\Filament\Pages;

use App\Livewire\ModulosWidget;
use Filament\Pages\Page;

class Modulos extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.modulos';

    protected function getHeaderWidgets(): array
    {
        return [
            ModulosWidget::class,
        ];
    }
}
