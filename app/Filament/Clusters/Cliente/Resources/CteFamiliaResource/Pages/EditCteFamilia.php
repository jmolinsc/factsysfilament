<?php

namespace App\Filament\Clusters\Cliente\Resources\CteFamiliaResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CteFamiliaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCteFamilia extends EditRecord
{
    protected static string $resource = CteFamiliaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
