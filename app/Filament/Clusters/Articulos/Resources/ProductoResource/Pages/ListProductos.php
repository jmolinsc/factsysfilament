<?php

namespace App\Filament\Clusters\Articulos\Resources\ProductoResource\Pages;

use App\Filament\Clusters\Articulos\Resources\ProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductos extends ListRecords
{
    protected static string $resource = ProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
