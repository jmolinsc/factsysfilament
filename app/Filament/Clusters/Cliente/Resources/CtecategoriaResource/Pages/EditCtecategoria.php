<?php

namespace App\Filament\Clusters\Cliente\Resources\CtecategoriaResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CtecategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCtecategoria extends EditRecord
{
    protected static string $resource = CtecategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
