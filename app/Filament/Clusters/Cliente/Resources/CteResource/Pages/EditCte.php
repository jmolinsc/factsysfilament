<?php

namespace App\Filament\Clusters\Cliente\Resources\CteResource\Pages;

use App\Filament\Clusters\Cliente\Resources\CteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JoseEspinal\RecordNavigation\Traits\HasRecordNavigation;

class EditCte extends EditRecord
{
    use HasRecordNavigation;
    protected static string $resource = CteResource::class;

    protected function getHeaderActions(): array
    {


       /* $existingActions = [
            Actions\DeleteAction::make(),
        ];*/

        return array_merge(parent::getActions(), $this->getNavigationActions());
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
