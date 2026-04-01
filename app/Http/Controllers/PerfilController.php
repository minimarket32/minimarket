<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; 

class PerfilController extends Controller
{
    public function update(Request $request)
    {
        $usuarioId = Session::get('usuario_id');

        // Validamos los datos para evitar errores de SQL o correos duplicados
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuarioId,
            'password' => 'nullable|min:6', 
        ]);

        $data = [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
        ];

        // Si el usuario escribió una nueva contraseña, la encriptamos antes de guardar
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('usuarios')->where('id', $usuarioId)->update($data);

        Session::put('usuario_nombre', $request->nombre);
        Session::put('usuario_correo', $request->correo); 

        return back()->with('success', 'Datos actualizados con éxito.');
    }

    public function updateSettings(Request $request)
    {
        Session::put('preferencia_notificaciones', $request->has('notificaciones'));
        Session::put('preferencia_ofertas', $request->has('ofertas'));

        return back()->with('success', 'Configuración de notificaciones guardada.');
    }

    public function deleteAccount()
    {
        DB::table('usuarios')->where('id', Session::get('usuario_id'))->update([
            'estado' => 'Eliminado'
        ]);

        Session::flush();
        return redirect()->route('login')->with('success', 'Tu cuenta ha sido inhabilitada correctamente.');
    }
}