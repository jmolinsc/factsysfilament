<?php

namespace App\Models;

use App\Filament\Clusters\Articulos\Resources\ProductoResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventad extends Model
{
    use HasFactory;


    protected $fillable = [
        'codigo',
        'productoid',
        'precio',
        'cantidad',
        'unidad',
        'descuentolinea',
        'importe',
        'ivaimp',
        'iva',
        'idventa'
    ];
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idventa');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productoid');
    }
}
