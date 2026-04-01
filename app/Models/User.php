<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'password',
        'rol',
        'estado',
    ];

    protected $hidden = [
        'password',
        // Quitamos remember_token de aquí si no existe en la DB
    ];

    // IMPORTANTE: Desactivar el uso de remember_token
    public function getRememberTokenName()
    {
        return null; // Laravel ya no buscará esa columna
    }
}