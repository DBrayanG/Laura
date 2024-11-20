<?php

namespace App\Http\Livewire\Pedido\Pedidos;

use App\Models\Pagina;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Livewire\Component;

class ShowPedido extends Component
{
    public $pedido;
    public $detalles;
    public $layout;

    public function mount($pedido)
    {
        $this->pedido = Pedido::GetPedido($pedido);
        $this->detalles = PedidoDetalle::GetDetalleByPedido($pedido);
        Pagina::UpdateVisita('pedido.show');
        $this->layout = auth()->user()->tema;
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('pedido.show') ?? 0;
        return view('livewire.pedido.pedidos.show-pedido', compact('visitas'))->layout($this->layout);
    }
}
