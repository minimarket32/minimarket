<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Hash, Session};

class RegistroController extends Controller
{
    public function index()
    {
        
        return view('auth.registro'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'correo'   => 'required|email|max:100|unique:usuarios,correo',
            'telefono' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed'
        ], [
            'correo.unique' => 'Este correo ya está registrado.',
            'password.confirmed' => 'Las contraseñas no coinciden.'
        ]);

        $usuarioId = DB::table('usuarios')->insertGetId([
            'nombre'   => $request->nombre,
            'telefono' => $request->telefono,
            'correo'   => $request->correo, 
            'password' => Hash::make($request->password),
            'rol'      => 'cliente',
            'estado'   => 'Activo',
            'intentos_fallidos' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('logs')->insert([
            'usuario_id'  => $usuarioId,
            'accion'      => 'Registro',
            'descripcion' => 'Nuevo cliente registrado: ' . $request->correo,
            'ip_origen'   => $request->ip()
        ]);

        Session::put('usuario_id', $usuarioId);
        Session::put('usuario_nombre', $request->nombre);
        Session::put('usuario_correo', $request->correo);
        Session::put('usuario_rol', 'cliente');

        return redirect()->route('cliente')
            ->with('success', '¡Registro exitoso! Bienvenido a MiniMarket.');
    }
}