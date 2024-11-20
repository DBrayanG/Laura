<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model
{
    use HasFactory;
    protected $fillable = [
        "cantidad",
        "precio",
        "carrito_id",
        "producto_id",
    ];
    protected $table = 'carrito_detalle';

    // Asociaciones

    // Funciones
    static public function CreateCarritoDetalle(array $data)
    {
        $new = CarritoDetalle::create([
            'cantidad' => $data['cantidad'],
            'precio' => $data['precio'],
            'carrito_id' => $data['carrito_id'],
            'producto_id' => $data['producto_id'],
        ]);
        return $new;
    }

    static public function UpdateCarritoDetalle($id, array $data)
    {
        $carrito = CarritoDetalle::find($id);
        $carrito->cantidad = $data['cantidad'] ?? $carrito->cantidad;
        $carrito->precio = $data['precio'] ?? $carrito->precio;
        $carrito->carrito_id = $data['carrito_id'] ?? $carrito->carrito_id;
        $carrito->producto_id = $data['producto_id'] ?? $carrito->producto_id;
        $carrito->save();
        return $carrito;
    }

    static public function DeleteCarritoDetalle($id)
    {
        $carrito = CarritoDetalle::find($id);
        $carrito->delete();
        return $carrito;
    }

    // static public function GetCarrito($attribute, $order = "desc", $paginate)
    // {
    //     $userId = auth()->user()->id;
    //     $carrito = Carrito::join('users', 'users.id', '=', 'carrito.usuario_id')
    //         ->select('carrito.*', 'users.name as usuario')
    //         ->where('users.id', '=', $userId)
    //         ->orWhere('users.name', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('carrito.fecha', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('carrito.hora', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('carrito.monto_total', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orderBy('carrito.id', $order)
    //         ->paginate($paginate);
    //     return $carrito;
    // }

    static public function GetCarritoDetalles()
    {
        $carrito = Carrito::GetCarrito();
        $carritoDetalles = CarritoDetalle::join('producto', 'producto.id', '=', 'carrito_detalle.producto_id')
            ->select('carrito_detalle.*', 'producto.nombre as producto', 'producto.imagen as imagen', 'producto.descripcion as descripcion')
            ->where('carrito_detalle.carrito_id', '=', $carrito->id)
            ->orderBy('carrito_detalle.id', 'desc')
            ->get();
        return $carritoDetalles;
    }

    static public function GetCantProducts()
    {
        $carrito = Carrito::GetCarrito();
        $carritoDetalles = CarritoDetalle::join('producto', 'producto.id', '=', 'carrito_detalle.producto_id')
            ->select('carrito_detalle.*', 'producto.nombre as producto')
            ->where('carrito_detalle.carrito_id', '=', $carrito->id)
            ->get();
        $cantProducts = 0;
        foreach ($carritoDetalles as $carritoDetalle) {
            $cantProducts += $carritoDetalle->cantidad;
        }
        return $cantProducts;
    }

    static public function ValidStock()
    {
        $detalles = CarritoDetalle::GetCarritoDetalles();
        foreach ($detalles as $detalle) {
            $producto = Producto::GetProducto($detalle->producto_id);
            if ($detalle->cantidad > $producto->cantidad) {
                return false;
            }
        }
        return true;
    }
}
