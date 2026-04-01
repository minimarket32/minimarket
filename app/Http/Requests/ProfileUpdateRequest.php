<?php

namespace App\Http\Requests;

use App\Models\User; // Usamos User ya que decidiste dejarlo con ese nombre
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     */
    public function rules(): array
    {
        return [
            // Validamos 'nombre' en lugar de 'name' según tu base de datos
            'nombre' => ['required', 'string', 'max:255'],
            
            // Validamos 'correo' en lugar de 'email'
            'correo' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // Regla de unicidad: busca en la tabla 'usuarios', columna 'correo'
                // Ignora al usuario actual para permitirle guardar si no cambió el correo
                Rule::unique('usuarios', 'correo')->ignore($this->user()->id),
            ],

            /**
             * MEJORA PROFESIONAL: Regla 'sometimes'
             * - sometimes: Solo valida si el campo 'password' está presente en el formulario.
             * - nullable: Permite que el campo esté vacío (si no se quiere cambiar la clave).
             * - confirmed: Exige que exista un campo 'password_confirmation' que coincida.
             */
            'password' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Mensajes de error personalizados para una mejor experiencia de usuario.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio para actualizar el perfil.',
            'correo.required' => 'El correo electrónico es necesario.',
            'correo.email'    => 'Por favor, ingresa una dirección de correo válida.',
            'correo.unique'   => 'Este correo electrónico ya está registrado por otro usuario.',
            'password.min'    => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];
    }
}