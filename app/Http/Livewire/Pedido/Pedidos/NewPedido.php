<?php

namespace App\Http\Livewire\Pedido\Pedidos;

use App\Models\Pagina;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class NewPedido extends Component
{
    public $pedidoArray = [];
    public $detalleArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public $productos = [];
    public $usuarios = [];


    public function mount()
    {
        Pagina::UpdateVisita('pedido.new');
        $this->layout = auth()->user()->tema;
        $this->pedidoArray = [
            'fecha' => new Date("Y-m-d"),
            'hora' => new Date("H:i:s"),
            'monto_total' => 0,
            'estado' => 'pendiente',
            'usuario_id' => '',
        ];
        $this->usuarios = User::GetAllUsuarios();
        // $this->productos = Producto::all();
    }

    public function addProducto($id, $cantidad)
    {
        // $producto = Producto::find($id);
        // $this->detalleArray[] = [
        //     'producto_id' => '',
        //     'cantidad' => 0,
        //     'precio' => 0,
        //     'subtotal' => 0,
        // ];
    }

    public function save()
    {
        $new = Pedido::CreatePedido($this->pedidoArray);
        if (!$new) {
            $this->message = 'Error al crear el pedido';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('pedido.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('pedido.new');
        return view('livewire.pedido.pedidos.new-pedido', compact('visitas'))->layout($this->layout);
    }
}
