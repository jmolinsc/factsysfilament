<?php

namespace App\Filament\Clusters\Cliente\Resources\AgenteResource\Pages;

use App\Filament\Clusters\Cliente\Resources\AgenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgente extends EditRecord
{
    protected static string $resource = AgenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
