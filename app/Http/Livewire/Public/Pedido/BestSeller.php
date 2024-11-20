<?php

namespace App\Http\Livewire\Public\Pedido;

use App\Models\Producto;
use Livewire\Component;

class BestSeller extends Component
{
    public $productos;

    public function mount()
    {
        $this->productos = Producto::GetProductosOrder('asc', 8);
    }

    function addCart($id)
    {
        $this->emit('addCart', $id, 1);
    }

    public function render()
    {
        return view('livewire.public.pedido.best-seller');
    }
}
