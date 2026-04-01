<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición de perfil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualiza la información del perfil del usuario.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Obtenemos los datos validados del Request profesional que creamos
        $data = $request->validated();

        // Si el usuario escribió una nueva contraseña, la encriptamos antes de guardar
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Si el campo password viene vacío (gracias al 'sometimes' y 'nullable'), 
            // lo quitamos del arreglo para no borrar la clave actual.
            unset($data['password']);
        }

        // Llenamos el modelo con los datos (nombre, correo, etc.)
        $user->fill($data);

        /**
         * Ajuste de Integridad:
         * Verificamos si cambió el 'correo' (antes era 'email'). 
         * Si cambió, invalidamos la verificación anterior.
         */
        if ($user->isDirty('correo')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina la cuenta del usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}