<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];
    public function cte()
    {
        return $this->hasMany(Cte::class, 'id');
    }
}
