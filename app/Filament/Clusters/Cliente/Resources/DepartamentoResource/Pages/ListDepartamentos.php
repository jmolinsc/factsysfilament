<?php

namespace App\Filament\Clusters\Cliente\Resources\DepartamentoResource\Pages;

use App\Filament\Clusters\Cliente\Resources\DepartamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDepartamentos extends ListRecords
{
    protected static string $resource = DepartamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
