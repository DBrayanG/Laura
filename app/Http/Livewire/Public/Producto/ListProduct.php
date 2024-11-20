<?php

namespace App\Http\Livewire\Public\Producto;

use App\Models\Pagina;
use App\Models\Producto;
use Livewire\Component;

class ListProduct extends Component
{
    public $productos;

    public function mount()
    {
        $this->productos = Producto::GetAllProductos();
        Pagina::UpdateVisita('public.producto.list');
    }

    function addCart($id)
    {
        $this->emit('addCart', $id, 1);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('public.producto.list') ?? 0;
        return view('livewire.public.producto.list-product', compact('visitas'))->layout('layouts.public', ['fondo' => false]);
    }
}
