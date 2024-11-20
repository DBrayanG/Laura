<?php

namespace App\Http\Livewire\Public\Pedido;

use Livewire\Component;

class ShowCarrito extends Component
{
    public function render()
    {
        return view('livewire.public.pedido.show-carrito')->layout('layouts.public', ['fondo' => false]);
    }
}
