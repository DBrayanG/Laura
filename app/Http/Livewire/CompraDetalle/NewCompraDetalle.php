<?php

namespace App\Http\Livewire\CompraDetalle;

use Livewire\Component;
use App\Models\CompraDetalle;
use App\Models\Pagina;
use App\Models\Producto;

class NewCompraDetalle extends Component
{
    public $detalleArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;
    public $compra_id;

    public $productos = [];

    public function mount($id)
    {
        $this->layout = auth()->user()->tema;
        $this->productos = Producto::GetAllProductos();
        $this->compra_id = $id;
        $this->detalleArray = ['compra_id' => $id];
        Pagina::UpdateVisita('compra-detalle.new');
    }

    public function save()
    {
        $new = CompraDetalle::CreateCompraDetalle($this->detalleArray);
        if (!$new) {
            $this->message = 'Error al añadir el detalle';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('compra.show', $this->compra_id);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('compra-detalle.new') ?? 0;
        return view('livewire.compra-detalle.new-compra-detalle', compact('visitas'))->layout(auth()->user()->tema);
    }
}
