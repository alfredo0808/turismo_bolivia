<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\EventoCultural;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = EventoCultural::where('activo', 1)
                                 ->with('destino')
                                 ->orderBy('mes')
                                 ->get()
                                 ->groupBy('mes');

        return view('front.eventos.index', compact('eventos'));
    }
}