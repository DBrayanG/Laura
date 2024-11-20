<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "correo",
        "contraseña",
        "direccion",
        "telefono",
        "cargo",
        "isCliente",
        "isEmpleado",
        "isAdministrador",
    ];
    protected $table = 'usuario';

    // Asociaciones

    // Funciones
    static public function GetUsuario(string $correo)
    {
        return Usuario::where('correo', $correo)->First();
    }

    static public function GetUsuarioById(int $id)
    {
        return Usuario::where('id', $id)->First();
    }
}
