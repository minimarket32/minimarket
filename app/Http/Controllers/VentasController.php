<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Ventas;
use App\Models\DetalleVenta;
use App\Models\SesionCaja;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index() {
        return view('ventas');
    }

    public function buscarProducto(Request $request) {
        $term = $request->query('term');
        
        if (empty($term)) {
            return response()->json(['success' => true, 'productos' => []]);
        }

        // Buscamos usando los campos de tu modelo Producto
        $productos = Producto::where('nombre', 'LIKE', "%{$term}%")
                    ->orWhere('codigo_barras', 'LIKE', "%{$term}%") 
                    ->orWhere('id', $term)
                    ->where('stock', '>', 0)
                    ->take(10)
                    ->get();

        return response()->json([
            'success' => true,
            'productos' => $productos // Enviamos el modelo tal cual, ya tiene codigo_barras y precio_venta
        ]);
    }

    public function store(Request $request) {
        $sesion = SesionCaja::where('estado', 'abierta')->first();
        if (!$sesion) {
            return response()->json(['success' => false, 'message' => 'Caja cerrada.'], 403);
        }

        try {
            DB::beginTransaction();

            $venta = Ventas::create([
                'usuario_id' => session('usuario_id') ?? 1,
                'total'      => $request->total,
                'fecha'      => now()
            ]);

            foreach ($request->productos as $item) {
                DetalleVenta::create([
                    'venta_id'        => $venta->id,
                    'producto_id'     => $item['producto_id'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio_venta'] // Usamos precio_venta
                ]);

                $p = Producto::find($item['producto_id']);
                $p->decrement('stock', $item['cantidad']);
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}