<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\Temporada;
use App\Models\EventoCultural;
use App\Models\ConsultaLog;

class PanelController extends Controller
{
    public function index()
    {
        $stats = [
            'destinos'  => Destino::where('activo', 1)->count(),
            'temporadas'=> Temporada::where('activo', 1)->count(),
            'eventos'   => EventoCultural::where('activo', 1)->count(),
            'consultas' => ConsultaLog::whereDate('fecha', today())->count(),
        ];

        $recientes = ConsultaLog::with('destino')
                                ->orderByDesc('created_at')
                                ->take(10)
                                ->get();

        return view('admin.panel', compact('stats', 'recientes'));
    }
}