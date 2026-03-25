<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\Categoria;
use App\Models\ConsultaLog;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    // Página principal con destinos destacados
    public function index()
    {
        $destacados  = Destino::where('activo', 1)
                              ->where('destacado', 1)
                              ->with('categoria')
                              ->take(6)
                              ->get();

        $categorias  = Categoria::where('activo', 1)->get();

        return view('front.home', compact('destacados', 'categorias'));
    }

    // Listado de todos los destinos
    public function listado(Request $request)
    {
        $query = Destino::where('activo', 1)->with('categoria');

        // Filtros
        if ($request->filled('departamento')) {
            $query->where('departamento', $request->departamento);
        }
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%'.$request->buscar.'%');
        }

        $destinos   = $query->paginate(9);
        $categorias = Categoria::where('activo', 1)->get();

        return view('front.destinos.listado', compact('destinos', 'categorias'));
    }

    // Detalle de un destino
    public function detalle($id)
    {
        $destino = Destino::where('activo', 1)
                          ->with(['categoria','imagenes','temporadas','eventos'])
                          ->findOrFail($id);

        // Registrar consulta
        ConsultaLog::create([
            'destino_id'   => $destino->id,
            'tipo_consulta'=> 'vista_detalle',
            'idioma'       => session('idioma', 'es'),
            'fecha'        => now()->toDateString(),
            'hora'         => now()->toTimeString(),
        ]);

        $relacionados = Destino::where('activo', 1)
                               ->where('categoria_id', $destino->categoria_id)
                               ->where('id', '!=', $destino->id)
                               ->take(3)
                               ->get();

        return view('front.destinos.detalle',
                    compact('destino', 'relacionados'));
    }
}