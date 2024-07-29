<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'mov',
        'movid',
        'fechaemision',
        'clienteid',
        'sucursal',
        'referencia',
        'concepto',
        'descuentoglobal',
        'condicion',
        'comentarios',
        'id_alm',

    ];


    public function alm()
    {
        return $this->belongsTo(Alm::class, 'id_alm');
    }

    public function ventads()
    {
        return $this->hasMany(Ventad::class, 'idventa');
    }

    public function cte()
    {
        return $this->belongsTo(Cte::class, 'clienteid');
    }
}
