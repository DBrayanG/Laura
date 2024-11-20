<?php

namespace App\Http\Livewire\Compra;

use Livewire\Component;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\CompraDetalle;
use App\Models\Pagina;
use Livewire\WithPagination;

class ShowCompra extends Component
{
    public $compra;
    public $proveedor;
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';

    public function mount($id)
    {
        $this->compra = Compra::GetCompra($id);
        $this->proveedor = Proveedor::GetProveedor($this->compra->proveedor_id);
        Pagina::UpdateVisita('compra.show');
    }

    public function toggleNotificacion()
    {
        $this->notificacion = !$this->notificacion;
        $this->emit('notificacion');
        $this->resetPage();
    }

    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        if (CompraDetalle::DeleteCompraDetalle($id)) {
            $this->message = 'Eliminado correctamente';
            $this->type = 'success';
        } else {
            $this->message = 'Error al eliminar';
            $this->type = 'error';
        }
        $this->notificacion = true;
    }

    public function detalle($id)
    {
        return redirect()->route('compra-detalle.new', $id);
    }

    public function render()
    {
        $detalles = CompraDetalle::GetDetalleByCompra($this->compra->id);
        $visitas = Pagina::GetPagina('compra.show') ?? 0;
        return view('livewire.compra.show-compra', compact('detalles', 'visitas'))->layout(auth()->user()->tema);
    }
}
