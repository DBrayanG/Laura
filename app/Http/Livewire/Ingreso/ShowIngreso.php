<?php

namespace App\Http\Livewire\Ingreso;

use Livewire\Component;
use App\Models\Ingreso;
use App\Models\IngresoDetalle;
use App\Models\Pagina;
use Livewire\WithPagination;

class ShowIngreso extends Component
{

    public $ingreso;
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';

    public function mount($id)
    {
        $this->ingreso = Ingreso::GetIngreso($id);
        Pagina::UpdateVisita('ingreso.show');
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
        if (IngresoDetalle::DeleteIngresoDetalle($id)) {
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
        return redirect()->route('ingreso-detalle.new', $id);
    }

    public function render()
    {
        $detalles = IngresoDetalle::GetDetalleByIngreso($this->ingreso->id);
        $visitas = Pagina::GetPagina('ingreso.show') ?? 0;
        return view('livewire.ingreso.show-ingreso', compact('detalles', 'visitas'))->layout(auth()->user()->tema);
    }
}
