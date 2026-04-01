<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductosController extends Controller
{
    public function index()
    {
        // Cargamos categorías para el modal y productos con su relación
        $productos = Producto::with('categoria')->orderBy('id', 'desc')->get();
        $categorias = Categoria::all(); 
        return view('productos', compact('productos', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_barras' => 'nullable|string|unique:productos,codigo_barras',
            'nombre'        => 'required|max:255',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'categoria_id'  => 'required|exists:categorias,id',
            'url_imagen'    => 'nullable|string',
        ]);

        Producto::create($request->all());
        
        return redirect()->back()->with('success', '¡Producto guardado correctamente!');
    }

    /**
     * NOTA: Como usas Modales en la misma vista, el método edit() 
     * no suele ser necesario a menos que uses una página aparte.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos_edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validamos que el código sea único, ignorando el ID del producto actual
            'codigo_barras' => 'nullable|string|unique:productos,codigo_barras,' . $id,
            'nombre'        => 'required|max:255',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'categoria_id'  => 'required|exists:categorias,id',
            'imagen'    => 'nullable|string',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        // Redirigimos atrás para mantenernos en la lista
        return redirect()->back()->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Producto eliminado.');
    }
}