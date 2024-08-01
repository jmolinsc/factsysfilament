<?php

namespace App\Filament\Clusters\Cliente\Resources\MunicipioResource\Pages;

use App\Filament\Clusters\Cliente\Resources\MunicipioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMunicipio extends CreateRecord
{
    protected static string $resource = MunicipioResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
