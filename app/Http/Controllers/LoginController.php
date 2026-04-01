<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Hash, Session, Mail, Notification};
use Illuminate\Support\Str;
use App\Mail\RecuperarPasswordMail;
use App\Notifications\LoginNotification;

class LoginController extends Controller
{
    
    public function index() { 
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $usuario = DB::table('usuarios')->where('correo', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'El correo no existe.']);
        }

        if ($usuario->estado === 'Eliminado') {
            return back()->withErrors(['email' => 'Esta cuenta ya no existe en nuestro sistema.']);
        }

        if ($usuario->estado === 'Bloqueado' || $usuario->intentos_fallidos >= 3) {
            DB::table('usuarios')->where('id', $usuario->id)->update(['estado' => 'Bloqueado']);
            return back()->withErrors(['email' => 'Cuenta bloqueada por seguridad. Contacte al administrador.']);
        }

        if (!Hash::check($request->password, $usuario->password)) {
            DB::table('usuarios')->where('id', $usuario->id)->increment('intentos_fallidos');
            
            $this->registrarLog($usuario->id, 'Intento Fallido', 'Contraseña incorrecta.');
            
            return back()->withErrors(['password' => 'Datos incorrectos.']);
        }

        
        DB::table('usuarios')->where('id', $usuario->id)->update(['intentos_fallidos' => 0]);

        $this->registrarLog($usuario->id, 'Inicio de Sesión', 'El usuario entró al sistema.');

        try {
            Notification::route('mail', $usuario->correo)->notify(new LoginNotification($usuario));
        } catch (\Exception $e) {
            \Log::error("Error enviando notificación: " . $e->getMessage());
        }

        Session::put('usuario_id', $usuario->id);
        Session::put('usuario_nombre', $usuario->nombre);
        Session::put('usuario_correo', $usuario->correo); 
        Session::put('usuario_rol', $usuario->rol);

        if ($usuario->rol === 'admin') {
            return redirect()->route('admin')->with('success', 'Bienvenido Admin');
        } 
        
        return redirect()->route('cliente')->with('success', 'Bienvenido ' . $usuario->nombre);
    }


    public function showForgotPasswordForm() {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request) {
        $request->validate(['correo' => 'required|email']);

        $usuario = DB::table('usuarios')->where('correo', $request->correo)->first();

        if (!$usuario) {
            return back()->withErrors(['correo' => 'Este correo no está registrado.']);
        }

        $token = Str::random(64);
        $url = route('password.reset', ['token' => $token]);

        $this->registrarLog($usuario->id, 'Solicitud Recuperación', 'El usuario pidió restablecer clave.');

        try {
            Mail::to($usuario->correo)->send(new RecuperarPasswordMail($usuario, $url));
            return back()->with('status', '¡Correo enviado! Revisa tu bandeja de entrada.');
        } catch (\Exception $e) {
            return back()->withErrors(['correo' => 'Error al enviar el correo.']);
        }
    }

    public function showResetForm($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'correo' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $usuario = DB::table('usuarios')->where('correo', $request->correo)->first();

        if (!$usuario) {
            return back()->withErrors(['correo' => 'Correo inválido.']);
        }

        DB::table('usuarios')->where('id', $usuario->id)->update([
            'password' => Hash::make($request->password),
            'intentos_fallidos' => 0,
            'estado' => 'Activo' 
        ]);

        $this->registrarLog($usuario->id, 'Cambio de Clave', 'Restablecimiento de contraseña exitoso.');

        return redirect()->route('login')->with('success', 'Contraseña actualizada.');
    }

    private function registrarLog($uid, $accion, $desc) {
        DB::table('logs')->insert([
            'usuario_id' => $uid,
            'accion' => $accion,
            'descripcion' => $desc,
            'ip_origen' => request()->ip(),
            'created_at' => now()
        ]);
    }

    
    public function logout(Request $request) {
        if (Session::has('usuario_id')) {
            $this->registrarLog(Session::get('usuario_id'), 'Cierre de Sesión', 'El usuario salió del sistema.');
        }

        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('minimarket')->with('success', 'Sesión cerrada correctamente.');
    }
}