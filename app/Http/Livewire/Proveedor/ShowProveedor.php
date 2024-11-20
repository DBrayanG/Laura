<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Pagina;
use App\Models\Proveedor;
use Livewire\Component;

class ShowProveedor extends Component
{
    public $proveedor;

    public function mount($proveedor)
    {
        $this->proveedor = Proveedor::find($proveedor);
        Pagina::UpdateVisita('proveedor.show');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('proveedor.show') ?? 0;
        return view('livewire.proveedor.show-proveedor', compact('visitas'))->layout(auth()->user()->tema);
    }
}
