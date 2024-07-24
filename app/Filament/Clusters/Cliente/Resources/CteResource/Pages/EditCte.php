<?php

namespace App\Filament\Clusters\Cliente\Resources\CteResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCte extends EditRecord
{
    protected static string $resource = CteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
