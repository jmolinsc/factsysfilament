<?php

namespace App\Filament\Clusters\Articulos\Resources\FamiliaResource\Pages;

use App\Filament\Clusters\Articulos\Resources\FamiliaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFamilias extends ListRecords
{
    protected static string $resource = FamiliaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
