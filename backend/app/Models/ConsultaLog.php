<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaLog extends Model
{
      protected $table      = 'consultas_log';
    public    $timestamps = false;
    protected $fillable   = [
        'destino_id','tipo_consulta','termino_busqueda',
        'idioma','dispositivo','ip_hash','fecha','hora'
    ];

    // Pertenece a un destino
    public function destino()
    {
        return $this->belongsTo(Destino::class, 'destino_id');
    }
}
