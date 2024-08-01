<?php

namespace App\Filament\Clusters\Cliente\Resources\DepartamentoResource\Pages;

use App\Filament\Clusters\Cliente\Resources\DepartamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDepartamento extends CreateRecord
{
    protected static string $resource = DepartamentoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
