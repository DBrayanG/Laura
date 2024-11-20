<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $fillable = [
        "fecha",
        "hora",
        "motivo"
    ];
    protected $table = 'ingreso';
    use HasFactory;

    // Funciones
    static public function CreateIngreso(array $data)
    {
        $new = Ingreso::create([
            'fecha' => $data['fecha'],
            'hora' => $data['hora'],
            'motivo' => $data['motivo']
        ]);
        return $new;
    }

    static public function UpdateIngreso($id, array $data)
    {
        $ingreso = Ingreso::find($id);
        $ingreso->motivo = $data['motivo'] ?? $ingreso->motivo;

        $ingreso->save();
        return $ingreso;
    }

    static public function DeleteIngreso($id)
    {
        $ingreso = Ingreso::find($id);

        $detallesIngreso = IngresoDetalle::where('ingreso_id', $id)->get();
        foreach ($detallesIngreso as $detalle) {
            $cantidad = $detalle->cantidad;
            //eliminar detalle
            $ingreso_detalle = IngresoDetalle::DeleteIngresoDetalle($detalle->id);
        }

        $ingreso->delete();
        return $ingreso;
    }

    static public function GetIngresos($attribute, $order = "desc", $paginate)
    {
        $ingreso = Ingreso::where('fecha', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $ingreso;
    }

    static public function GetAllIngresos()
    {
        $ingreso = Ingreso::all();
        return $ingreso;
    }

    static public function GetIngreso($id)
    {
        $ingreso = Ingreso::find($id);
        return $ingreso;
    }
}
