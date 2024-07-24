<?php

namespace App\Filament\Clusters\Cliente\Resources\AgenteResource\Pages;

use App\Filament\Clusters\Cliente\Resources\AgenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgentes extends ListRecords
{
    protected static string $resource = AgenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
