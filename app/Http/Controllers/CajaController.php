<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionCaja;
use App\Models\Ventas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CajaController extends Controller
{
    /**
     * Vista principal de la Caja
     */
    public function index()
    {
        $sesion = SesionCaja::where('estado', 'abierta')->first();

        // Si no hay sesión abierta, enviamos todo en cero
        if (!$sesion) {
            return view('caja', [
                'ingresos' => 0, 
                'apertura' => 0, 
                'egresos' => 0, 
                'saldo_final' => 0, 
                'sesion' => null
            ]);
        }

        // Formateamos la fecha de inicio para la consulta
        $inicio = Carbon::parse($sesion->fecha_apertura)->format('Y-m-d H:i:s');
        
        // Calculamos Ventas (Ingresos)
        $ingresos = Ventas::where('fecha', '>=', $inicio)->sum('total') ?? 0;
        
        // Calculamos Egresos (Gastos) de la tabla manual
        $egresos = DB::table('egresos')->where('created_at', '>=', $inicio)->sum('monto') ?? 0;

        return view('caja', [
            'sesion' => $sesion,
            'ingresos' => $ingresos,
            'egresos' => $egresos,
            'apertura' => $sesion->monto_apertura,
            'saldo_final' => ($sesion->monto_apertura + $ingresos) - $egresos
        ]);
    }

    /**
     * Abrir una nueva sesión de caja
     */
    public function abrir(Request $request)
    {
        $request->validate([
            'monto_apertura' => 'required|numeric|min:0'
        ]);

        SesionCaja::create([
            'usuario_id' => Auth::id() ?? 1,
            'monto_apertura' => $request->monto_apertura,
            'fecha_apertura' => now()->format('Y-m-d H:i:s'),
            'estado' => 'abierta'
        ]);

        return redirect()->route('caja')->with('success', 'Caja abierta con éxito');
    }

    /**
     * Registrar un nuevo Egreso (Gasto)
     */
    public function guardarEgreso(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:1',
            'descripcion' => 'required|string|max:255'
        ]);

        // Insertar en la tabla egresos
        DB::table('egresos')->insert([
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Gasto registrado y descontado');
    }

    /**
     * Cerrar la sesión actual
     */
    public function cierre()
    {
        $sesion = SesionCaja::where('estado', 'abierta')->first();
        
        if($sesion) {
            $inicio = Carbon::parse($sesion->fecha_apertura)->format('Y-m-d H:i:s');
            $ventas = Ventas::where('fecha', '>=', $inicio)->sum('total') ?? 0;
            $gastos = DB::table('egresos')->where('created_at', '>=', $inicio)->sum('monto') ?? 0;
            
            // La lógica matemática final
            $totalCierre = ($sesion->monto_apertura + $ventas) - $gastos;

            $sesion->update([
                'fecha_cierre' => now()->format('Y-m-d H:i:s'),
                'total_ventas' => $ventas,
                'monto_cierre' => $totalCierre,
                'estado' => 'cerrada'
            ]);
        }
        return redirect()->route('caja')->with('success', 'Caja cerrada correctamente');
    }

    /**
     * Ver historial de cierres
     */
    public function historial()
    {
        $historial = SesionCaja::orderBy('id', 'desc')->get();
        return view('historial_cajas', compact('historial'));
    }
}