<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Salida;
use App\Models\Producto;

class SalidaDetalle extends Model
{
    protected $fillable = [
        "cantidad",
        "salida_id",
        "producto_id"
    ];
    protected $table = 'salida_detalle';
    use HasFactory;

    // Funciones
    static public function CreateSalidaDetalle(array $data)
    {
        $new = SalidaDetalle::create([
            'cantidad' => $data['cantidad'],
            'salida_id' => $data['salida_id'],
            'producto_id' => $data['producto_id']
        ]);
        $producto = Producto::updateStock($new->producto_id, - $new->cantidad);
        return $new;
    }

    static public function DeleteSalidaDetalle($id)
    {
        $salidaDetalle = SalidaDetalle::find($id);
        $producto = Producto::updateStock($salidaDetalle->producto_id, + $salidaDetalle->cantidad);
        $salidaDetalle->delete();
        return $salidaDetalle;
    }

    static public function GetSalidaDetallesByIdSalida($id)
    {
        $salidaDetalle = SalidaDetalle::where('salida_id', $id)->get();
        return $salidaDetalle;
    }

    static public function GetDetalleBySalida(int $id)
    {
        $salidaDetalles = SalidaDetalle::join('producto', 'producto.id', '=', 'salida_detalle.producto_id')
            ->select('salida_detalle.*', 'producto.nombre as producto', 'producto.imagen as imagen')
            ->where('salida_detalle.salida_id', '=', $id)
            ->orderBy('salida_detalle.id', 'desc')
            ->get();
        return $salidaDetalles;
    }

    static public function GetSalidaDetalle($id)
    {
        $salidaDetalle = SalidaDetalle::find($id);
        return $salidaDetalle;
    }
}
