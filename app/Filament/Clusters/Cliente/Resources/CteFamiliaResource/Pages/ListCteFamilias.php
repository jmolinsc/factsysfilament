<?php

namespace App\Filament\Clusters\Cliente\Resources\CteFamiliaResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CteFamiliaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCteFamilias extends ListRecords
{
    protected static string $resource = CteFamiliaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
