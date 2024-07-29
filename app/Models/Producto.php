<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    static $rules = [
        'producto' => 'required',
        'tipo' => 'required',
        'precio_compra' => 'required',
        'precio_venta' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'producto',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'foto',
        'peso',
        'unidad',
        'id_categoria',
        'id_fabricante', 'id_familia', 'id_linea',
        'tipo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class, 'id_fabricante');
    }

    public function familia()
    {
        return $this->belongsTo(Familia::class, 'id_familia');
    }

    public function linea()
    {
        return $this->belongsTo(Linea::class, 'id_linea');
    }

    public function ventads()
    {
        return $this->hasMany(Ventad::class, 'productoid');
    }
}
