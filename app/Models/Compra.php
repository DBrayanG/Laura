<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\CompraDetalle;

class Compra extends Model
{
    protected $fillable = [
        "fecha",
        "hora",
        "monto_total",
        "proveedor_id"
    ];
    protected $table = 'compra';
    use HasFactory;
    // Funciones
    static public function CreateCompra(array $data)
    {
        $new = Compra::create([
            'fecha' => $data['fecha'],
            'hora' => $data['hora'],
            'monto_total' => 0,
            'proveedor_id' => $data['proveedor_id']
        ]);
        return $new;
    }

    static public function UpdateCompra($id, array $data)
    {
        $compra = Compra::find($id);
        $compra->monto_total = $data['monto_total'] ?? $producto->monto_total;

        $compra->save();
        return $compra;
    }

    static public function DeleteCompra($id)
    {
        $compra = Compra::find($id);

        $detallesCompra = CompraDetalle::where('compra_id', $id)->get();
        foreach ($detallesCompra as $detalle) {
            $cantidad = $detalle->cantidad;
            //actualizar datos en el producto
            $producto = Producto::updateStock($detalle->producto_id, -$detalle->cantidad);
            //eliminar detalle
            CompraDetalle::DeleteCompraDetalle($detalle->id);
        }

        $compra->delete();
        return $compra;
    }

    static public function GetCompras($attribute, $order = "desc", $paginate)
    {
        $compra = Compra::where('fecha', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $compra;
    }

    static public function GetAllCompras()
    {
        $compra = Compra::join('proveedor', 'proveedor.id', '=', 'compra.proveedor_id')
        ->select('compra.*', 'proveedor.nombre as nombre')
        ->orderBy('compra.id', 'desc')
        ->get();
        return $compra;
    }

    static public function GetCompra($id)
    {
        $compra = Compra::find($id);
        return $compra;
    }

    static public function GetValueCompras()
    {
        $compra = Compra::sum('monto_total');
        return $compra;
    }
}
