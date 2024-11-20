<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "ruta",
        "visitas",
    ];
    protected $table = 'pagina';

    // Asociaciones

    // Funciones
    static public function UpdateVisita(string $ruta)
    {
        $pagina = Pagina::where('ruta', $ruta)->First();
        if (!$pagina) return;
        $pagina->visitas++;
        return $pagina->save();
    }

    static public function GetPagina(string $ruta)
    {
        return Pagina::where('ruta', $ruta)->First()->visitas ?? 0;
    }

    static public function GetMoreVisited()
    {
        return Pagina::orderBy('visitas', 'desc')->limit(10)->get();
    }
}
