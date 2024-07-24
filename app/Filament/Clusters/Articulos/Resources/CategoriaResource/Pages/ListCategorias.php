<?php

namespace App\Filament\Clusters\Articulos\Resources\CategoriaResource\Pages;

use App\Filament\Clusters\Articulos\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategorias extends ListRecords
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
