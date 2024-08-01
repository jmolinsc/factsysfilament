<?php

namespace App\Filament\Resources\AlmResource\Pages;

use App\Filament\Resources\AlmResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAlm extends CreateRecord
{
    protected static string $resource = AlmResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
