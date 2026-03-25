<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Temporada;
use App\Models\Destino;

class TemporadaController extends Controller
{
    // Recomendaciones por mes
    public function recomendaciones($mes = null)
    {
        $mes = $mes ?? now()->month;

        $destinos = Destino::where('activo', 1)
                           ->whereHas('temporadas', function($q) use ($mes) {
                               $q->where('mes_inicio', '<=', $mes)
                                 ->where('mes_fin', '>=', $mes)
                                 ->where('nivel', 'alta')
                                 ->where('activo', 1);
                           })
                           ->with(['categoria', 'temporadas'])
                           ->get();

        return view('front.temporadas.recomendaciones',
                    compact('destinos', 'mes'));
    }
}