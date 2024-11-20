<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha",
        "hora",
        "monto_total",
        "estado",
        "usuario_id",
    ];
    protected $table = 'pedido';

    // Asociaciones

    // Funciones
    static public function CreatePedido()
    {
        $carrito = Carrito::GetCarrito();
        $new = Pedido::create([
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
            'monto_total' => $carrito->monto_total,
            'estado' => 'pendiente',
            'usuario_id' => auth()->user()->id,
        ]);
        PedidoDetalle::crearPedidoDetalle($new->id);
        Carrito::DeleteCarrito($carrito->id);
        return $new;
    }

    static public function UpdatePedido($id, array $data)
    {
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->area = $data['area'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }

    static public function DeletePedido($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }

    static public function GetPedidos($attribute, $order = "desc", $paginate)
    {
        $users = Pedido::join('users', 'users.id', '=', 'pedido.usuario_id')
            ->select('pedido.*', 'users.name as usuario')
            ->orWhere('users.name', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('pedido.estado', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('pedido.id', $order)
            ->paginate($paginate);
        return $users;
    }

    static public function GetAllPedidos()
    {
        $users = User::all();
        return $users;
    }

    static public function GetPedido($id)
    {
        return Pedido::find($id);
    }

    static public function GetPedidosByUsuario(int $id)
    {
        return Pedido::where('usuario_id', $id)->get();
    }

    static public function GetValueVentas()
    {
        $pedidos = Pedido::where('estado', 'Completado')->get();
        $monto = 0;
        foreach ($pedidos as $pedido) {
            $monto = $monto + $pedido->monto_total;
        }
        return $monto;
    }
}
