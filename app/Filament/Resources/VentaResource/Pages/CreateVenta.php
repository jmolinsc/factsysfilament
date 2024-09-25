<?php

namespace App\Filament\Resources\VentaResource\Pages;

use App\Filament\Resources\VentaResource;
use App\Models\Venta;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateVenta extends CreateRecord
{
    protected static string $resource = VentaResource::class;



    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Send Offer')
                ->icon('heroicon-o-envelope')
                ->action(function () {
                    $data = $this->getRecord();
                    dd($this->data);
                })

        ];
    }


}
