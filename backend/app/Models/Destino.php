<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    //protected $table    = 'destinos';
    protected $fillable = [
        'categoria_id','nombre','descripcion','departamento',
        'ubicacion','latitud','longitud','altitud_msnm',
        'imagen_portada','activo','destacado'
    ];

    // Pertenece a una categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Tiene muchas imagenes
    public function imagenes()
    {
        return $this->hasMany(ImagenDestino::class, 'destino_id');
    }

    // Tiene muchas temporadas
    public function temporadas()
    {
        return $this->hasMany(Temporada::class, 'destino_id');
    }

    // Tiene muchos eventos
    public function eventos()
    {
        return $this->hasMany(EventoCultural::class, 'destino_id');
    }

    // Tiene muchas consultas
    public function consultas()
    {
        return $this->hasMany(ConsultaLog::class, 'destino_id');
    }
}
