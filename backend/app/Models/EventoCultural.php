<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoCultural extends Model
{
    protected $table    = 'eventos_culturales';
    protected $fillable = [
        'destino_id','nombre','descripcion','tipo',
        'mes','dia_inicio','dia_fin','es_anual','activo'
    ];

    // Pertenece a un destino
    public function destino()
    {
        return $this->belongsTo(Destino::class, 'destino_id');
    }
}
