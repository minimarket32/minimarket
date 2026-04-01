<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Producto; 

class GestionClienteController extends Controller
{
    private function verificarAdmin()
    {
        if (!Session::has('usuario_id') || Session::get('usuario_rol') !== 'admin') {
            return redirect()->route('login')->withErrors(['Acceso no autorizado']);
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->verificarAdmin()) { return $redirect; }
        
        $clientes = DB::table('usuarios')
            ->where('rol', 'cliente')
            ->where('estado', '!=', 'Eliminado')
            ->orderBy('created_at', 'desc')
            ->get();

        // El nombre debe ser 'gestionclientes' (sin puntos ni espacios)
        return view('gestionclientes', compact('clientes'));
    }

    public function store(Request $request)
    {
        if ($redirect = $this->verificarAdmin()) { return $redirect; }
        
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'correo'   => 'required|email|unique:usuarios,correo',
            'telefono' => 'required|string|max:20',
            'password' => 'required|min:6'
        ]);

        DB::table('usuarios')->insert([
            'nombre'     => $request->nombre,
            'correo'     => $request->correo, 
            'telefono'   => $request->telefono,
            'password'   => Hash::make($request->password),
            'rol'        => 'cliente',
            'estado'     => 'Activo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->verificarAdmin()) { return $redirect; }
        
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'correo'   => 'required|email|unique:usuarios,correo,' . $id,
            'telefono' => 'required|string|max:20',
            'estado'   => 'required|in:Activo,Inactivo'
        ]);

        DB::table('usuarios')->where('id', $id)->update([
            'nombre'     => $request->nombre,
            'correo'     => $request->correo,
            'telefono'   => $request->telefono,
            'estado'     => $request->estado, 
            'updated_at' => now()
        ]);

        return redirect()->route('clientes.index')->with('success', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        if ($redirect = $this->verificarAdmin()) { return $redirect; }
        
        DB::table('usuarios')->where('id', $id)->update([
            'estado'     => 'Eliminado', 
            'updated_at' => now()
        ]);
        
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado del sistema');
    }

    public function panelCliente(Request $request)
    {
        $busqueda = $request->input('buscar');
        $categoriaFiltro = $request->input('categoria');

        $query = Producto::with('categoria');

        if ($request->filled('categoria') && $categoriaFiltro !== 'Todas') {
            $query->whereHas('categoria', function($q) use ($categoriaFiltro) {
                $q->where('nombre', $categoriaFiltro);
            });
        }

        if ($request->filled('buscar')) {
            $query->where('nombre', 'LIKE', '%' . $busqueda . '%');
        }

        $productos = $query->where('stock', '>', 0)->get();
        return view('cliente', compact('productos'));
    }
}