<?php

namespace App\Http\Livewire\Producto;

use App\Models\Pagina;
use App\Models\Producto;
use Livewire\Component;

class ShowProducto extends Component
{

    public $producto;

    public function mount($producto)
    {
        $this->producto = Producto::find($producto);
        Pagina::UpdateVisita('producto.show');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('producto.show') ?? 0;
        return view('livewire.producto.show-producto', compact('visitas'))->layout(auth()->user()->tema);
    }
}
