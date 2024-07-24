<?php

namespace App\Filament\Clusters\Articulos\Resources\FabricanteResource\Pages;

use App\Filament\Clusters\Articulos\Resources\FabricanteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFabricantes extends ListRecords
{
    protected static string $resource = FabricanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
