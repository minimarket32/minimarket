<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    // Muestra la vista del carrito
    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    // Agrega productos al carrito (Sesión)
    public function agregar(Request $request)
    {
        $producto = Producto::find($request->producto_id);

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $carrito = session()->get('carrito', []);

        // Si ya existe, aumenta cantidad; si no, lo crea
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad']++;
        } else {
            $carrito[$producto->id] = [
                "nombre" => $producto->nombre,
                "cantidad" => 1,
                "precio" => $producto->precio_venta,
                "imagen" => $producto->imagen
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', '¡' . $producto->nombre . ' agregado al carrito!');
    }

    /**
     * Elimina un producto específico del carrito
     */
    public function eliminar(Request $request)
    {
        if($request->id) {
            $carrito = session()->get('carrito');
            if(isset($carrito[$request->id])) {
                unset($carrito[$request->id]);
                session()->put('carrito', $carrito);
            }
            return redirect()->back()->with('success', 'Producto eliminado');
        }
    }

    /**
     * Vacía todo el carrito
     */
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('cliente')->with('success', 'El carrito se ha vaciado');
    }
}