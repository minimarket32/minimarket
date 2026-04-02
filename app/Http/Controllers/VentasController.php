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

    /**
     * Buscar productos para el POS
     * Corregido para PostgreSQL (Render)
     */
    public function buscarProducto(Request $request) {
        $term = $request->query('term');
        
        if (empty($term)) {
            return response()->json(['success' => true, 'productos' => []]);
        }

        // Usamos ILIKE para búsquedas que ignoren mayúsculas/minúsculas en Postgres
        $productos = Producto::where(function($query) use ($term) {
                        $query->where('nombre', 'ILIKE', "%{$term}%")
                              ->orWhere('codigo_barras', 'ILIKE', "%{$term}%");
                        
                        // Solo buscamos por ID si el término es un número para evitar errores de tipo en Postgres
                        if (is_numeric($term)) {
                            $query->orWhere('id', $term);
                        }
                    })
                    ->where('stock', '>', 0) // Solo productos con existencias
                    ->take(10)
                    ->get();

        return response()->json([
            'success' => true,
            'productos' => $productos 
        ]);
    }

    /**
     * Guardar la venta y descontar stock
     */
    public function store(Request $request) {
        // Verificar si hay una sesión de caja abierta
        $sesion = SesionCaja::where('estado', 'abierta')->first();
        if (!$sesion) {
            return response()->json(['success' => false, 'message' => 'No hay una sesión de caja abierta.'], 403);
        }

        try {
            DB::beginTransaction();

            $venta = Ventas::create([
                'usuario_id' => session('usuario_id') ?? 1,
                'total'      => $request->total,
                'fecha'      => now() // Asegúrate de que tu tabla tenga la columna 'fecha'
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
