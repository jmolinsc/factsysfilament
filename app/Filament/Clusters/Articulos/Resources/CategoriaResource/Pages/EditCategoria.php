<?php

namespace App\Filament\Clusters\Articulos\Resources\CategoriaResource\Pages;

use App\Filament\Clusters\Articulos\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
