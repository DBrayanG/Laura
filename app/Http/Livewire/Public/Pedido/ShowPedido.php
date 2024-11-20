<?php

namespace App\Http\Livewire\Public\Pedido;

use App\Models\Pagina;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Livewire\Component;

class ShowPedido extends Component
{
    public $pedido;
    public $detalles;

    public function mount($id)
    {
        $this->pedido = Pedido::GetPedido($id);
        $this->detalles = PedidoDetalle::GetDetalleByPedido($id);
        Pagina::UpdateVisita('public.pedido.show');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('public.pedido.show') ?? 0;
        return view('livewire.public.pedido.show-pedido', compact('visitas'))->layout('layouts.public', ['fondo' => false]);
    }
}
