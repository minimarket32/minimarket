<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria; 
use Illuminate\Support\Facades\Session;

class MinimarketController extends Controller
{
    public function publico(Request $request)
    {
        $productos = $this->filtrarProductos($request);
        $categoriasMenu = Categoria::all(); 

        return view('minimarket', compact('productos', 'categoriasMenu'));
    }

    public function cliente(Request $request)
    {
        if (!Session::has('usuario_id') || Session::get('usuario_rol') != 'cliente') {
            return redirect()->route('login');
        }

        $productos = $this->filtrarProductos($request);
        $categoriasMenu = Categoria::all(); 

        return view('cliente', compact('productos', 'categoriasMenu'));
    }

    private function filtrarProductos(Request $request)
    {
        $categoriaId = $request->get('categoria'); 
        $buscar = $request->get('buscar');

        $query = Producto::with('categoria');

        // 1. Filtro por nombre
        if ($buscar) {
            $query->where('nombre', 'LIKE', "%{$buscar}%");
        }

        // 2. CORRECCIÓN: La columna real en tu SQL es 'categoria_id'
        if ($categoriaId && $categoriaId !== 'Todas') {
            $query->where('categoria_id', $categoriaId);
        }

        return $query->get();
    }

    public function admin()
    {
        if (!Session::has('usuario_id') || Session::get('usuario_rol') != 'admin') {
            return redirect()->route('login');
        }

        return view('admin');
    }
}