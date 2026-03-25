<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traduccion extends Model
{
     protected $table    = 'traducciones';
    protected $fillable = [
        'tabla','campo','registro_id','idioma','contenido'
    ];
}
