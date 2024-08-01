<?php

namespace App\Filament\Resources\VentaResource\Pages;

use App\Filament\Resources\VentaResource;
use Filament\Actions\Modal\Actions\Action;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;



class CreateVenta extends CreateRecord
{
    protected static string $resource = VentaResource::class;



    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        /*  return [
            Action::make('Afectar')->icon('heroicon-s-cog') ->action(function (array $data): void {
               Log::info('PRUEBA');
               // $this->record->save();
            }),
           
        ]; */

        return [
            Actions\ActionGroup::make([
                Action::make('Afectar')->icon('heroicon-s-cog') ->action(function (array $data): void {
                    Log::info('PRUEBA');
                    // $this->record->save();
                 }),
                 Action::make('Afectar')->icon('heroicon-s-cog') ->action(function (array $data): void {
                    Log::info('PRUEBA');
                    // $this->record->save();
                 }),
                 Action::make('Afectar')->icon('heroicon-s-cog') ->action(function (array $data): void {
                    Log::info('PRUEBA');
                    // $this->record->save();
                 }),
            ]),
        ];
    }
}
