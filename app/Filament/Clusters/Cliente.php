<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Cliente extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Cuentas';

    protected static bool $shouldRegisterNavigation = false;
}
