<?php

namespace App\Filament\Clusters\Cliente\Resources\CtecategoriaResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CtecategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCtecategorias extends ListRecords
{
    protected static string $resource = CtecategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
