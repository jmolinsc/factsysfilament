<?php

namespace App\Filament\Resources\VentadResource\Pages;

use App\Filament\Resources\VentadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVentads extends ListRecords
{
    protected static string $resource = VentadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
