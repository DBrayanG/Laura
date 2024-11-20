<?php

namespace App\Http\Livewire\Public\Pedido;

use App\Models\Pagina;
use App\Models\Pedido;
use Livewire\Component;

class ListPedido extends Component
{
    public $pedidos;

    public function mount()
    {
        $userId = auth()->user()->id;
        $this->pedidos = Pedido::GetPedidosByUsuario($userId);
        Pagina::UpdateVisita('public.pedido');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('public.pedido') ?? 0;
        return view('livewire.public.pedido.list-pedido', compact('visitas'))->layout('layouts.public', ['fondo' => false]);
    }
}
