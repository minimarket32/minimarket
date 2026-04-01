<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\User; // <--- DEBE SER USER

class DatabaseSeeder extends Seeder
{
   public function run(): void
{
    // Crear 50 productos
    \App\Models\Producto::factory(50)->create();

    // Crear un Admin de prueba que coincida con tu estructura
    \App\Models\User::factory()->create([
        'nombre' => 'Admin MiniMarket',
        'correo' => 'admin@minimarket.com',
        'password' => bcrypt('admin123'),
        'rol' => 'admin',
        'estado' => 'Activo',
    ]);
}
}