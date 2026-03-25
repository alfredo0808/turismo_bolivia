<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminDestinoController extends Controller
{
    public function index()
    {
        $destinos = Destino::with('categoria')->paginate(10);
        return view('admin.destinos.index', compact('destinos'));
    }

    public function create()
    {
        $categorias = Categoria::where('activo', 1)->get();
        return view('admin.destinos.form', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:150',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion'  => 'required',
            'departamento' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen_portada')) {
            $data['imagen_portada'] = $request->file('imagen_portada')
                                              ->store('destinos', 'public');
        }

        Destino::create($data);
        return redirect()->route('admin.destinos.index')
                         ->with('success', 'Destino creado correctamente.');
    }

    public function edit($id)
    {
        $destino    = Destino::findOrFail($id);
        $categorias = Categoria::where('activo', 1)->get();
        return view('admin.destinos.form',
                    compact('destino', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $destino = Destino::findOrFail($id);

        $request->validate([
            'nombre'       => 'required|string|max:150',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion'  => 'required',
            'departamento' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen_portada')) {
            $data['imagen_portada'] = $request->file('imagen_portada')
                                              ->store('destinos', 'public');
        }

        $destino->update($data);
        return redirect()->route('admin.destinos.index')
                         ->with('success', 'Destino actualizado correctamente.');
    }

    public function destroy($id)
    {
        $destino = Destino::findOrFail($id);
        $destino->update(['activo' => 0]);
        return redirect()->route('admin.destinos.index')
                         ->with('success', 'Destino eliminado correctamente.');
    }
}
