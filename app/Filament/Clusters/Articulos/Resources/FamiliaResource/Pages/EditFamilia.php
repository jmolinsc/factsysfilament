<?php

namespace App\Filament\Clusters\Articulos\Resources\FamiliaResource\Pages;

use App\Filament\Clusters\Articulos\Resources\FamiliaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFamilia extends EditRecord
{
    protected static string $resource = FamiliaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
