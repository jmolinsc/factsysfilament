<?php

namespace App\Filament\Resources\VentaResource\Pages;

use App\Filament\Resources\VentaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Application\Started;

class CreateVenta extends CreateRecord
{
    protected static string $resource = VentaResource::class;

    protected function getFormActions(): array
    {
        return array_merge(parent::getFormActions(), [
            Actions\Action::make('Afectar')
                ->action(function () {
                    Log::info('AFECTAD');
                })
            ],
        );
    }

   




}
