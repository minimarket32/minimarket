<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionCaja extends Model
{
    protected $table = 'sesiones_caja';
    protected $fillable = ['usuario_id', 'monto_apertura', 'monto_cierre', 'total_ventas', 'fecha_apertura', 'fecha_cierre', 'estado'];
    public $timestamps = false; // Usamos nuestras propias fechas
}