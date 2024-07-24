<?php

namespace App\Filament\Clusters\Articulos\Resources\LineaResource\Pages;

use App\Filament\Clusters\Articulos\Resources\LineaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLineas extends ListRecords
{
    protected static string $resource = LineaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
