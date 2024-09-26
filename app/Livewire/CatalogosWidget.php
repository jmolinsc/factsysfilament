<?php

namespace App\Livewire;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CatalogosWidget extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make('Clientes', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'clientes()'
                ]),
            Stat::make('Articulos', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'art()'
                ]),
            Stat::make('Almacen', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'alm()'
                ]),
            Stat::make('Agente', 1234)
                ->descriptionIcon('shopping-cart', IconPosition::Before)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => 'agente()'
                ]),

        ];
    }

    public function clientes()
    {
        return $this->redirect('/admin/cliente/ctes', navigate: true);
    }

    public function art()
    {
        return $this->redirect('/admin/articulos/productos', navigate: true);
    }

    public function alm()
    {
        return $this->redirect('/admin/alms', navigate: true);
    }
}
