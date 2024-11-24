<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha",
        "hora",
        "monto_total",
        "usuario_id",
    ];
    protected $table = 'carrito';

    // Asociaciones

    // Funciones
    static public function CreateCarrito(array $data)
    {
        $new = Carrito::create([
            'fecha' => $data['fecha'],
            'hora' => $data['hora'],
            'monto_total' => $data['monto_total'],
            'usuario_id' => $data['usuario_id'],
        ]);
        return $new;
    }

    static public function UpdateCarrito(array $data)
    {
        $carrito = Carrito::GetCarrito();
        $carrito->fecha = $data['fecha'] ?? $carrito->fecha;
        $carrito->hora = $data['hora'] ?? $carrito->hora;
        $carrito->monto_total = $data['monto_total'] ?? $carrito->monto_total;
        $carrito->usuario_id = $data['usuario_id'] ?? $carrito->usuario_id;
        $carrito->save();
        return $carrito;
    }

    static public function DeleteCarrito($id)
    {
        $carrito = Carrito::find($id);
        CarritoDetalle::where('carrito_id', $carrito->id)->delete();
        $carrito->delete();
        return $carrito;
    }

    static public function UpdateMontoTotal($monto)
    {
        $carrito = Carrito::GetCarrito();
        $carrito->monto_total = $monto;
        $carrito->save();
        return $carrito;
    }

    static public function GetCarrito()
    {
        // if (!auth()->user()) {
        //     return redirect()->route('login');
        // }
        if (!Carrito::exitsCarrito()) {
            $userId = auth()->user()->id;
            $carrito = Carrito::create([
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
                'monto_total' => 0,
                'usuario_id' => $userId,
            ]);
            return $carrito;
        }
        $userId = auth()->user()->id;
        $carrito = Carrito::join('users', 'users.id', '=', 'carrito.usuario_id')
            ->select('carrito.*', 'users.name as usuario')
            ->where('users.id', '=', $userId)
            ->first();
        return $carrito;
    }

    static public function exitsCarrito()
    {
        $userId = auth()->user()->id;
        $carrito = Carrito::join('users', 'users.id', '=', 'carrito.usuario_id')
            ->select('carrito.*', 'users.name as usuario')
            ->where('users.id', '=', $userId)
            ->first();
        if ($carrito) {
            return true;
        } else {
            return false;
        }
    }
}
