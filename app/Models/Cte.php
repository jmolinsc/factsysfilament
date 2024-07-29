<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cte extends Model
{
    use HasFactory;

    static $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'telefono' => 'required',
        'direccion' => 'required',
        //'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    protected $fillable = [
        'codigo',
        'nombre',
        'telefono',
        'direccion',
        'dui',
        'email',
        'nit',
        'nrc', 'tipo', 'id_ctegrupo',
        'id_ctefamilia', 'id_pais',
        'id_departamento', 'id_agente', 'id_ctecategoria'
    ];
    protected $perPage = 20;


    public function ctecategoria()
    {
        return $this->belongsTo(CteCategoria::class, 'id_ctecategoria');
    }


    public function ctefamilia()
    {
        return $this->belongsTo(CteFamilia::class, 'id_ctefamilia');
    }


    public function ctegrupo()
    {
        return $this->belongsTo(CteGrupo::class, 'id_ctegrupo');
    }


    public function pais()
    {
        return $this->belongsTo(Pais::class, 'id_pais');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function agente()
    {
        return $this->belongsTo(Agente::class, 'id_agente');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
