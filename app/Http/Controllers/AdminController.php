<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminController extends Controller implements HasMiddleware
{
    /**
     * Definición de Middleware para Laravel 11/12
     */
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                if (!Session::has('usuario_id') || Session::get('usuario_rol') !== 'admin') {
                    return redirect()->route('login')->withErrors(['Debe iniciar sesión para acceder al panel.']);
                }
                return $next($request);
            }),
        ];
    }

    /**
     * Dashboard Principal con datos reales de la BD
     */
    public function index()
    {
        // 1. Conteo de productos
        $totalProductos = DB::table('productos')->count();

        // 2. Conteo de clientes (usuarios con rol cliente)
        $totalClientes = DB::table('usuarios')->where('rol', 'cliente')->count();

        /**
         * 3. Suma de ventas totales de HOY
         * Importante: Usamos 'created_at' que es el estándar de Laravel. 
         * Si en tu tabla ventas se llama 'fecha', cámbialo abajo.
         */
        $ventasHoy = DB::table('ventas')
            ->whereDate('created_at', Carbon::today())
            ->sum('total');

        /**
         * 4. Estado de la caja
         * Verifica que la tabla 'sesiones_caja' exista en Render.
         */
        $cajaAbierta = DB::table('sesiones_caja')
            ->where('estado', 'abierta')
            ->exists();

        return response()
            ->view('admin', compact('totalProductos', 'totalClientes', 'ventasHoy', 'cajaAbierta'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }

    /**
     * BUSCAR PRODUCTOS (Corregido para PostgreSQL con ILIKE)
     * Esta función permite buscar por ID, Nombre o Código de Barras
     */
    public function buscarProducto(Request $request)
    {
        $term = $request->texto;

        // Usamos ILIKE para que no importe si escribes en mayúsculas o minúsculas en Render
        $productos = DB::table('productos')
            ->where('id', 'LIKE', $term) 
            ->orWhere('nombre', 'ILIKE', '%' . $term . '%')
            ->orWhere('codigo_barras', 'ILIKE', '%' . $term . '%')
            ->get();

        return response()->json($productos);
    }

    /**
     * Actualizar Perfil del Administrador
     */
    public function perfilUpdate(Request $request)
    {
        $id = Session::get('usuario_id');
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo,'.$id,
        ]);

        $updateData = [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('usuarios')->where('id', $id)->update($updateData);

        Session::put('usuario_nombre', $request->nombre);
        Session::put('usuario_correo', $request->correo);

        return back()->with('success', 'Perfil actualizado con éxito');
    }

    /**
     * Ajustes de preferencias
     */
    public function perfilSettings(Request $request)
    {
        return back()->with('success', 'Preferencias guardadas correctamente');
    }

    /**
     * Inhabilitar cuenta de Administrador
     */
    public function perfilDelete()
    {
        $id = Session::get('usuario_id');
        
        DB::table('usuarios')->where('id', $id)->update(['estado' => 'bloqueado']);

        Session::flush();
        return redirect()->route('login')->with('success', 'Cuenta inhabilitada correctamente.');
    }

    /**
     * Cerrar Sesión
     */
    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
