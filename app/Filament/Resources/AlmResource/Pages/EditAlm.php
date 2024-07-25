<?php

namespace App\Filament\Resources\AlmResource\Pages;

use App\Filament\Resources\AlmResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlm extends EditRecord
{
    protected static string $resource = AlmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
