<?php

namespace App\Filament\Clusters\Cliente\Resources\MunicipioResource\Pages;

use App\Filament\Clusters\Cliente\Resources\MunicipioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMunicipios extends ListRecords
{
    protected static string $resource = MunicipioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
