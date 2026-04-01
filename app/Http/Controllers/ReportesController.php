<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportesController extends Controller
{
    /**
     * Muestra el panel principal de reportes
     * Esta función responde a la ruta: name('reportes')
     */
    public function index(Request $request)
    {
        // Capturar fechas del filtro. Si no hay, usar el día de hoy.
        $desde = $request->get('desde', now()->format('Y-m-d'));
        $hasta = $request->get('hasta', now()->format('Y-m-d'));

        // 1. Suma total de Ventas en el rango seleccionado
        $totalVentas = Ventas::whereBetween('fecha', [$desde . ' 00:00:00', $hasta . ' 23:59:59'])
                            ->sum('total') ?? 0;

        // 2. Suma total de Egresos (Gastos) en el rango seleccionado
        $totalEgresos = DB::table('egresos')
                            ->whereBetween('created_at', [$desde . ' 00:00:00', $hasta . ' 23:59:59'])
                            ->sum('monto') ?? 0;

        // 3. Cálculo de Balance (Ventas menos Gastos)
        $balance = $totalVentas - $totalEgresos;

        // 4. Conteo de transacciones totales
        $conteoVentas = Ventas::whereBetween('fecha', [$desde . ' 00:00:00', $hasta . ' 23:59:59'])
                            ->count();

        // Retornamos la vista 'reportes' con las variables necesarias
        return view('reportes', compact('totalVentas', 'totalEgresos', 'balance', 'conteoVentas', 'desde', 'hasta'));
    }

    // Estos métodos quedan listos por si decides crear rutas adicionales luego
    public function ventasDiarias()
    {
        $hoy = now()->format('Y-m-d');
        $total = Ventas::whereDate('fecha', $hoy)->sum('total');
        return "Reporte Ventas Diarias: $ " . number_format($total);
    }

    public function ventasMensuales()
    {
        $mes = now()->month;
        $total = Ventas::whereMonth('fecha', $mes)->sum('total');
        return "Reporte Ventas Mensuales: $ " . number_format($total);
    }
}