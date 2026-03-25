<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temporada;
use App\Models\Destino;
use Illuminate\Http\Request;

class AdminTemporadaController extends Controller
{
    public function index()
    {
        $temporadas = Temporada::with('destino')
                               ->paginate(10);
        return view('admin.temporadas.index', compact('temporadas'));
    }

    public function create()
    {
        $destinos = Destino::where('activo', 1)->get();
        return view('admin.temporadas.form', compact('destinos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destino_id'  => 'required|exists:destinos,id',
            'mes_inicio'  => 'required|integer|between:1,12',
            'mes_fin'     => 'required|integer|between:1,12',
            'nivel'       => 'required|in:alta,media,baja',
            'descripcion' => 'required',
            'clima'       => 'required',
        ]);

        Temporada::create($request->all());

        return redirect()->route('admin.temporadas.index')
                         ->with('success', 'Temporada creada correctamente.');
    }

    public function edit($id)
    {
        $temporada = Temporada::findOrFail($id);
        $destinos  = Destino::where('activo', 1)->get();
        return view('admin.temporadas.form',
                    compact('temporada', 'destinos'));
    }

    public function update(Request $request, $id)
    {
        $temporada = Temporada::findOrFail($id);

        $request->validate([
            'destino_id'  => 'required|exists:destinos,id',
            'mes_inicio'  => 'required|integer|between:1,12',
            'mes_fin'     => 'required|integer|between:1,12',
            'nivel'       => 'required|in:alta,media,baja',
            'descripcion' => 'required',
            'clima'       => 'required',
        ]);

        $temporada->update($request->all());

        return redirect()->route('admin.temporadas.index')
                         ->with('success', 'Temporada actualizada correctamente.');
    }

    public function destroy($id)
    {
        $temporada = Temporada::findOrFail($id);
        $temporada->update(['activo' => 0]);
        return redirect()->route('admin.temporadas.index')
                         ->with('success', 'Temporada eliminada correctamente.');
    }
}