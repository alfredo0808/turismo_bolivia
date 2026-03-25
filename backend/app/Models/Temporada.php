<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $table    = 'temporadas';
    protected $fillable = [
        'destino_id','mes_inicio','mes_fin','nivel',
        'descripcion','clima','temperatura_min','temperatura_max',
        'precipitacion','nivel_afluencia','activo'
    ];

    // Pertenece a un destino
    public function destino()
    {
        return $this->belongsTo(Destino::class, 'destino_id');
    }
}
