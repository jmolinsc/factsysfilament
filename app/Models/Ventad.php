<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventad extends Model
{
    use HasFactory;


    protected $fillable = [
        'codigo',
        'producto',
        'precio',
        'cantidad',
        'unidad',
        'descuentolinea',
        'importe',
        'ivaimp',
        'iva',
        'idventa',
    ];
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idventa');
    }
}
