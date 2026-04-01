<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;
// database/factories/ProductoFactory.php
public function definition(): array
{
    $productosPorCategoria = [
        1 => ['Jabón Rey', 'Detergente Fab'],
        2 => ['Arroz Roa', 'Frijol Bola Roja'],
        3 => ['Lulo', 'Tomate de Árbol'],
        4 => ['Pony Malta', 'Postobón Manzana'],
        5 => ['Leche Alquería', 'Quesito Colanta'],
        6 => ['Carne Molida', 'Pechuga de Pollo'],
        7 => ['Atún Van Camps', 'Sardinas Isabel'],
        8 => ['Papas Margarita', 'Chocoramo'],
        9 => ['Promoción Aceite', 'Combo Arroz'],
    ];

    $categoriaId = $this->faker->numberBetween(1, 9);
    $nombreBase = $this->faker->randomElement($productosPorCategoria[$categoriaId]);

    return [
        // Usamos lexify para que el nombre sea único y no falle la DB
        'nombre' => $this->faker->unique()->lexify($nombreBase . ' - ???'),
        'descripcion' => 'Producto de alta calidad', // Esta columna ya existe en tu SQL
        'precio' => $this->faker->randomFloat(2, 2000, 50000),
        'stock' => $this->faker->numberBetween(1, 100),
        'categoria_id' => $categoriaId,
    ];
}
}