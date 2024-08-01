<?php

namespace App\Filament\Clusters\Cliente\Resources\MunicipioResource\Pages;

use App\Filament\Clusters\Cliente\Resources\MunicipioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMunicipio extends EditRecord
{
    protected static string $resource = MunicipioResource::class;

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
