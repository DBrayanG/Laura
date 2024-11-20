<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        "nombre",
        "imagen",
        "tamaño",
        "precio",
        "cantidad",
        "descripcion",
        "categoria"
    ];
    protected $table = 'producto';

    // Funciones
    static public function CreateProducto(array $data)
    {
        $new = Producto::create([
            'nombre' => $data['nombre'],
            'imagen' => $data['imagen'],
            'tamaño' => $data['tamaño'],
            'precio' => $data['precio'],
            'cantidad' => 0,
            'descripcion' => $data['descripcion'],
            'categoria' => $data['categoria']
        ]);
        return $new;
    }

    static public function UpdateProducto($id, array $data)
    {
        $producto = Producto::find($id);
        $producto->nombre = $data['nombre'] ?? $producto->nombre;
        $producto->imagen = $data['imagen'] ?? $producto->imagen;
        $producto->tamaño = $data['tamaño'] ?? $producto->tamaño;
        $producto->precio = $data['precio'] ?? $producto->precio;
        $producto->descripcion = $data['descripcion'] ?? $producto->descripcion;
        $producto->save();
        return $producto;
    }

    static public function DeleteProducto($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return $producto;
    }

    static public function GetProductos($attribute, $order = "desc", $paginate)
    {
        $producto = Producto::where('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $producto;
    }

    static public function GetAllProductos()
    {
        $producto = Producto::all();
        return $producto;
    }

    static public function GetProductosOrder($order, $limit)
    {
        $producto = Producto::orderBy('id', $order)->limit($limit)->get();
        return $producto;
    }

    static public function GetProducto($id)
    {
        $producto = Producto::find($id);
        return $producto;
    }


    static public function updateStock($id, $cantidad)
    {
        $producto = Producto::find($id);
        $producto->cantidad = $producto->cantidad + $cantidad;
        $producto->save();
        return $producto;
    }
    static public function UpdatePrecio($id, $precio)
    {
        $producto = Producto::find($id);
        $producto->precio = $precio;
        $producto->save();
        return $producto;
    }
}
