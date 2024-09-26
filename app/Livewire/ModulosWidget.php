<?php

namespace App\Livewire;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ModulosWidget extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make('Venta', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'venta()'
                ]),
            Stat::make('Cxc', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'venta()'
                ]),
            Stat::make('Cxp', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'venta()'
                ]),
            Stat::make('Inv', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'venta()'
                ]),
                Stat::make('Inv', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'venta()'
                ]),
                Stat::make('Inv', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'venta()'
                ]),
        ];
    }

    public function venta()
    {
        return $this->redirect('/admin/ventas', navigate: true);
    }
}
