<?php

namespace App\Http\Livewire\Public\Producto;

use App\Models\Pagina;
use App\Models\Producto;
use Livewire\Component;

class ShowProduct extends Component
{
    public $producto;

    public function mount($id)
    {
        $this->producto = Producto::GetProducto($id);
        Pagina::UpdateVisita('public.producto.show');
    }

    function addCart($id)
    {
        $this->emit('addCart', $id, 1);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('public.producto.show') ?? 0;
        return view('livewire.public.producto.show-product', compact('visitas'))->layout('layouts.public', ['fondo' => false]);
    }
}
