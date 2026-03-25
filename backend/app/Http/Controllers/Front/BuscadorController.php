<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\ConsultaLog;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function buscar(Request $request)
    {
        $termino = $request->input('q');

        $destinos = Destino::where('activo', 1)
                           ->where(function($query) use ($termino) {
                               $query->where('nombre', 'like', '%'.$termino.'%')
                                     ->orWhere('descripcion', 'like', '%'.$termino.'%')
                                     ->orWhere('departamento', 'like', '%'.$termino.'%');
                           })
                           ->with('categoria')
                           ->paginate(9);

        // Registrar busqueda
        ConsultaLog::create([
            'tipo_consulta'    => 'busqueda',
            'termino_busqueda' => $termino,
            'idioma'           => session('idioma', 'es'),
            'fecha'            => now()->toDateString(),
            'hora'             => now()->toTimeString(),
        ]);

        return view('front.destinos.listado',
                    compact('destinos', 'termino'));
    }

    // Cambio de idioma
    public function cambiarIdioma($idioma)
    {
        if (in_array($idioma, ['es', 'en'])) {
            session(['idioma' => $idioma]);
            app()->setLocale($idioma);
        }
        return back();
    }
}
