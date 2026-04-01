<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo_barras', // Agregado
        'nombre', 
        'precio_compra', // Agregado
        'precio_venta',  // Agregado
        'precio',        // Mantenlo si aún usas la columna vieja
        'stock', 
        'categoria_id', 
        'descripcion', 
        'imagen'
    ]; 

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}