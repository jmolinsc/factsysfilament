<?php

namespace App\Filament\Clusters\Cliente\Resources\CteResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCtes extends ListRecords
{
    protected static string $resource = CteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
