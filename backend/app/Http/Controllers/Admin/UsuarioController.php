<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:150',
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required|min:8|confirmed',
            'rol'      => 'required|in:superadmin,admin,editor',
        ]);

        Usuario::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => $request->rol,
            'activo'   => 1,
        ]);

        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.form', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:150',
            'email'  => 'required|email|unique:usuarios,email,'.$id,
            'rol'    => 'required|in:superadmin,admin,editor',
        ]);

        $data = $request->only('nombre', 'email', 'rol', 'activo');

        // Solo actualiza password si se ingresó uno nuevo
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update(['activo' => 0]);
        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario desactivado correctamente.');
    }
}
