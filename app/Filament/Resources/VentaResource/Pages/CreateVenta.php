<?php

namespace App\Filament\Resources\VentaResource\Pages;

use App\Filament\Resources\VentaResource;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Pages\CreateRecord;


class CreateVenta extends CreateRecord
{
    protected static string $resource = VentaResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateInDraftFormAction(),
            $this->getCreateAndConfirmFormAction(),
            $this->getCancelFormAction(),
        ];
    }



    protected function getCreateInDraftFormAction(): Action
    {
        return Action::make('createindraft')
        ->label('Save to Draft')
        ->action(function(){
            $this->data['status'] = 'draft';
            $this->create();
        });
    }



    protected function getCreateAndConfirmFormAction(): Action
    {
        return Action::make('createandconfirm')
            ->label('Save and Confirm')
            ->submit('createandconfirm');
    }
}
