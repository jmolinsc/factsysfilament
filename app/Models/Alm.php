<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alm extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'nombre',
        'direccion',
        'sucursal',
        'encargado',
        'cuentacontable',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
