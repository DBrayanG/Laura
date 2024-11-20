<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        "nombre",
        "correo",
        "telefono",
        "direccion",
        "nit"
    ];
    protected $table = 'proveedor';
    use HasFactory;

    // Funciones
    static public function CreateProveedor(array $data)
    {
        $new = Proveedor::create([
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'nit' => $data['nit']
        ]);
        return $new;
    }

    static public function UpdateProveedor($id, array $data)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->nombre = $data['nombre'] ?? $proveedor->nombre;
        $proveedor->correo = $data['correo'] ?? $proveedor->correo;
        $proveedor->telefono = $data['telefono'] ?? $proveedor->telefono;
        $proveedor->direccion = $data['direccion'] ?? $proveedor->direccion;
        $proveedor->nit = $data['nit'] ?? $proveedor->nit;

        $proveedor->save();
        return $proveedor;
    }

    static public function DeleteProveedor($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();
        return $proveedor;
    }

    static public function GetProveedores($attribute, $order = "desc", $paginate)
    {
        $proveedor = Proveedor::where('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('correo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $proveedor;
    }

    static public function GetAllProveedores()
    {
        $proveedor = Proveedor::all();
        return $proveedor;
    }

    static public function GetProveedor($id)
    {
        $proveedor = Proveedor::find($id);
        return $proveedor;
    }
}
