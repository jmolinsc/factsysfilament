<?php

namespace App\Filament\Clusters\Cliente\Resources\PaisResource\Pages;

use App\Filament\Clusters\Cliente\Resources\PaisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPais extends EditRecord
{
    protected static string $resource = PaisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
