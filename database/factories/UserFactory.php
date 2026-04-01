<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

   public function definition(): array
{
    return [
        'nombre'   => fake()->name(),
        'telefono' => fake()->phoneNumber(),
        'correo'   => fake()->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'rol'      => 'cliente',
        'estado'   => 'Activo',
    ];
}
    
    // Borra la función unverified() si la tienes, para evitar errores
}