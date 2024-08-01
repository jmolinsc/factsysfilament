<?php

namespace App\Filament\Clusters\Cliente\Resources\CteFamiliaResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CteFamiliaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCteFamilia extends CreateRecord
{
    protected static string $resource = CteFamiliaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
