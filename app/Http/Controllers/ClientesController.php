<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Producto; 
use App\Models\Categoria;

class ClientesController extends Controller
{
    /**
     * Verifica si el usuario en sesión es administrador.
     */
    private function verificarAdmin()
    {
        if (!Session::has('usuario_id') || Session::get('usuario_rol') !== 'admin') {
            return redirect()->route('login')->withErrors(['Acceso no autorizado']);
        }
        return null;
    }

    /**
     * Muestra la lista de clientes (Solo Admin).
     */
    public function index()
    {
        if ($redirect = $this->verificarAdmin()) { return $redirect; }
        
        $clientes = DB::table('usuarios')
            ->where('rol', 'cliente')
            ->where('estado', '!=', 'Eliminado')
            ->get();
            
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Registra un nuevo cliente desde el panel admin.
     */
    public function store(Request $request)
    {
        if ($redirect = $this->verificarAdmin()) { return $redirect; }
        
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo',
            'telefono' => 'required|string|max:20',
            'password' => 'required|min:6'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => $request->nombre,
            'usuario' => $request->correo,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'rol' => 'cliente',
            'estado' => 'Activo', 
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    /**
     * Actualiza los datos de un cliente.
     */
    public function update(Request $request, $id)
    {
        if ($redirect = $this->verificarAdmin()) { return $redirect; }
        
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
            'telefono' => 'required|string|max:20'
        ]);

        DB::table('usuarios')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'usuario' => $request->correo,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'updated_at' => now()
        ]);

        // Si el admin se edita a sí mismo, actualizamos su sesión
        if (Session::get('usuario_id') == $id) {
            Session::put('usuario_nombre', $request->nombre);
            Session::put('usuario_correo', $request->correo);
        }

        return redirect()->route('clientes.index')->with('success', 'Datos actualizados');
    }

    /**
     * Eliminación lógica de un cliente.
     */
    public function destroy($id)
    {
        if ($redirect = $this->verificarAdmin()) { return $redirect; }
        
        DB::table('usuarios')
            ->where('id', $id)
            ->update(['estado' => 'Eliminado', 'updated_at' => now()]);
            
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado');
    }

    /**
     * CARGA EL PANEL DE COMPRAS PARA EL CLIENTE
     * Aquí corregimos la columna a 'categoria_id'
     */
    public function panelCliente(Request $request)
    {
        // 1. Verificar que sea cliente para ver este panel
        if (!Session::has('usuario_id') || Session::get('usuario_rol') !== 'cliente') {
            return redirect()->route('login');
        }

        $busqueda = $request->input('buscar');
        $categoriaId = $request->input('categoria'); 

        // 2. Categorías para el menú lateral
        $categoriasMenu = Categoria::all();

        // 3. Consulta de productos (Eager Loading para evitar errores en la vista)
        $query = Producto::with('categoria');

        // 4. FILTRO DE CATEGORÍA: Corregido a 'categoria_id' según tu SQL
        if ($request->filled('categoria') && $categoriaId !== 'Todas') {
            $query->where('categoria_id', $categoriaId);
        }

        // 5. FILTRO DE BÚSQUEDA
        if ($request->filled('buscar')) {
            $query->where('nombre', 'LIKE', '%' . $busqueda . '%');
        }

        $productos = $query->get();

        return view('cliente', compact('productos', 'categoriasMenu'));
    }
}