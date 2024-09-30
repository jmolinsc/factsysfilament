<?php

namespace App\Filament\Clusters\Cliente\Resources\CteResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JoseEspinal\RecordNavigation\Traits\HasRecordsList;

class ListCtes extends ListRecords
{

    use HasRecordsList;
    protected static string $resource = CteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
