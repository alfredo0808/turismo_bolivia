<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table      = 'categorias';
    protected $fillable   = ['nombre','descripcion','icono','activo'];

    // Un categoria tiene muchos destinos
    public function destinos()
    {
        return $this->hasMany(Destino::class, 'categoria_id');
    }
}
