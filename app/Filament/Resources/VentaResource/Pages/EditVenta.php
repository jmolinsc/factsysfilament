<?php

namespace App\Filament\Resources\VentaResource\Pages;

use App\Filament\Resources\VentaResource;
use App\Models\Cte;
use App\Models\CteFamilia;
use App\Models\Venta;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class EditVenta extends EditRecord
{
    protected static string $resource = VentaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //  Actions\DeleteAction::make(),
            /* EditAction::make('Afectar')
                ->using(function (Model $record, array $data): Model {
                    $data["movid"] = "123342";
                    $record->update($data);

                    return $record;
                }),*/
            Action::make('Afectar')
                ->icon('heroicon-o-envelope')
                ->action(function () {
                    $this->data["movid"] = 'MT3';
                    $cte = CteFamilia::create(['nombre' => "NUEVO"]);
                    $d =  $this->record->update($this->data);
                    //  $records = $this->handleRecordUpdate($this->record, $this->data);
                }),
            Action::make('sendEmail')
                ->action(function (array $data) {
                    $record = $this->update($data);
                    dump($record);
                }),
            Action::make('delete')
                ->action(function () {
                    $dataresponse = $this->venta->update($this->data);
                    dump($dataresponse);
                })
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $record->update($data);
        return $record;
    }
}
