<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class InventarioController extends Controller
{
  
    public function index()
    {
        $productos = Producto::orderBy('id','desc')->get();
        return view('inventario', compact('productos'));
    }

   
    public function update($id)
    {
        $producto = Producto::findOrFail($id);

        

        return redirect()->route('inventario')
                         ->with('success','Stock actualizado');
    }
}