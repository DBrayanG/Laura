<?php

namespace App\Http\Livewire\Public\Pedido;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Livewire\Component;

class PagarQR extends Component
{
    public $pedido;
    public $detalles;

    public function mount($id)
    {
        $this->pedido = Pedido::GetPedido($id);
        $this->detalles = PedidoDetalle::GetDetalleByPedido($id);
    }

    public function render()
    {
        return view('livewire.public.pedido.pagar-q-r')->layout('layouts.public', ['fondo' => false]);
    }
}
