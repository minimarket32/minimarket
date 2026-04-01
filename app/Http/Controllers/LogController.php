<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index()
    {
        // Consultamos la tabla 'logs' de tu base de datos
        // Ordenamos por id descendente para que lo más nuevo salga arriba
        $logs = DB::table('logs')
                  ->orderBy('id', 'desc')
                  ->take(100) // Opcional: limitamos a los últimos 100 registros
                  ->get();

        return view('logs', compact('logs'));
    }

    public function clear()
    {
        // En lugar de vaciar un archivo, vaciamos la tabla de la base de datos
        try {
            DB::table('logs')->truncate();
            return redirect()->back()->with('success', 'Historial de base de datos limpiado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo limpiar la tabla: ' . $e->getMessage());
        }
    }
}