<?php

namespace App\Filament\Resources\AlmResource\Pages;

use App\Filament\Resources\AlmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlms extends ListRecords
{
    protected static string $resource = AlmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
