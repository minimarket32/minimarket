<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambiado a true para permitir la validación
    }

    public function rules(): array
    {
        $id = $this->route('producto'); // Captura el ID en caso de edición

        return [
            'nombre'       => "required|string|max:255|unique:productos,nombre,{$id}",
            'precio'       => "required|numeric|min:0",
            'stock'        => "required|integer|min:0",
            'categoria_id' => "required|exists:categorias,id",
            'imagen'       => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique'   => 'Este producto ya existe en el inventario.',
            'precio.numeric'  => 'El precio debe ser un número.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ];
    }
}