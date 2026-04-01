<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    // Importante: Laravel por defecto busca una llave primaria 'id'. 
    // Si tu tabla la tiene, esto está bien.
    protected $fillable = [
        'usuario_id',
        'total',
        'fecha'
    ];

    // Desactivamos los timestamps automáticos (created_at/updated_at)
    public $timestamps = false; 

    // Quitamos el cast por ahora para que MySQL maneje la fecha directamente 
    // y evitar que el servidor se quede "pensando" procesando el objeto Carbon.
}