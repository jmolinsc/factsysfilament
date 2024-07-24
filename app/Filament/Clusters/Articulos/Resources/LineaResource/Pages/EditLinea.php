<?php

namespace App\Filament\Clusters\Articulos\Resources\LineaResource\Pages;

use App\Filament\Clusters\Articulos\Resources\LineaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLinea extends EditRecord
{
    protected static string $resource = LineaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
