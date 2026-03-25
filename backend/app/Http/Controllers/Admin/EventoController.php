<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventoCultural;
use App\Models\Destino;
use Illuminate\Http\Request;

class AdminEventoController extends Controller
{
    public function index()
    {
        $eventos = EventoCultural::with('destino')
                                 ->orderBy('mes')
                                 ->paginate(10);
        return view('admin.eventos.index', compact('eventos'));
    }

    public function create()
    {
        $destinos = Destino::where('activo', 1)->get();
        return view('admin.eventos.form', compact('destinos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destino_id'  => 'required|exists:destinos,id',
            'nombre'      => 'required|string|max:200',
            'tipo'        => 'required|in:festival,feria,carnaval,feriado,ceremonia,gastronomico,deportivo,otro',
            'mes'         => 'required|integer|between:1,12',
            'descripcion' => 'required',
        ]);

        EventoCultural::create($request->all());

        return redirect()->route('admin.eventos.index')
                         ->with('success', 'Evento creado correctamente.');
    }

    public function edit($id)
    {
        $evento   = EventoCultural::findOrFail($id);
        $destinos = Destino::where('activo', 1)->get();
        return view('admin.eventos.form',
                    compact('evento', 'destinos'));
    }

    public function update(Request $request, $id)
    {
        $evento = EventoCultural::findOrFail($id);

        $request->validate([
            'destino_id'  => 'required|exists:destinos,id',
            'nombre'      => 'required|string|max:200',
            'tipo'        => 'required|in:festival,feria,carnaval,feriado,ceremonia,gastronomico,deportivo,otro',
            'mes'         => 'required|integer|between:1,12',
            'descripcion' => 'required',
        ]);

        $evento->update($request->all());

        return redirect()->route('admin.eventos.index')
                         ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $evento = EventoCultural::findOrFail($id);
        $evento->update(['activo' => 0]);
        return redirect()->route('admin.eventos.index')
                         ->with('success', 'Evento eliminado correctamente.');
    }
}