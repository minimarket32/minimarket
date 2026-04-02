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

        /**
         * CORRECCIÓN PARA POSTGRESQL:
         * 1. Usamos ILIKE en lugar de LIKE para ignorar mayúsculas/minúsculas.
         * 2. Agrupamos los OR en una función anónima para que el filtro de stock > 0 se aplique siempre.
         */
        $productos = Producto::where(function($query) use ($term) {
                        $query->where('nombre', 'ILIKE', "%{$term}%")
                              ->orWhere('codigo_barras', 'ILIKE', "%{$term}%");
                        
                        // Solo buscamos por ID si el término es numérico para evitar errores en Postgres
                        if (is_numeric($term)) {
                            $query->orWhere('id', $term);
                        }
                    })
                    ->where('stock', '>', 0) // Solo productos con existencia
                    ->take(10)
                    ->get();

        return response()->json([
            'success' => true,
            'productos' => $productos 
        ]);
    }

    public function store(Request $request) {
        // Verificar si hay una sesión de caja abierta antes de vender
        $sesion = SesionCaja::where('estado', 'abierta')->first();
        if (!$sesion) {
            return response()->json(['success' => false, 'message' => 'No hay una sesión de caja abierta.'], 403);
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
                    'precio_unitario' => $item['precio_venta'] 
                ]);

                // Descontar del inventario
                $p = Producto::find($item['producto_id']);
                if ($p) {
                    $p->decrement('stock', $item['cantidad']);
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
