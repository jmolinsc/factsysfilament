<?php

namespace App\Filament\Clusters\Cliente\Resources\CteGrupoResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CteGrupoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCteGrupo extends EditRecord
{
    protected static string $resource = CteGrupoResource::class;

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
