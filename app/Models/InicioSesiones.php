<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InicioSesiones extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha",
        "hora",
        "ip",
        "usuario_id",
    ];
    protected $table = 'inicio_sesiones';

    // Asociaciones

    // Funciones
    static public function CreateSesion($arrayData)
    {
        return InicioSesiones::create($arrayData);
    }

    static public function GetLastSesiones()
    {
        return InicioSesiones::join('users', 'users.id', '=', 'inicio_sesiones.usuario_id')
            ->select('inicio_sesiones.*', 'users.name as nombre')
            ->orderBy('inicio_sesiones.id', 'desc')->limit(10)->get();
    }
}
