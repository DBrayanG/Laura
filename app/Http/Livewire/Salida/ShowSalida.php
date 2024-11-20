<?php

namespace App\Http\Livewire\Salida;

use App\Models\Pagina;
use Livewire\Component;
use App\Models\Salida;
use App\Models\SalidaDetalle;
use Livewire\WithPagination;

class ShowSalida extends Component
{
    public $salida;
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';

    public function mount($id)
    {
        $this->salida = Salida::GetSalida($id);
        Pagina::UpdateVisita('salida.show');
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
        if (SalidaDetalle::DeleteSalidaDetalle($id)) {
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
        return redirect()->route('salida-detalle.new', $id);
    }

    public function render()
    {
        $detalles = SalidaDetalle::GetDetalleBySalida($this->salida->id);
        $visitas = Pagina::GetPagina('salida.show') ?? 0;
        return view('livewire.salida.show-salida', compact('detalles', 'visitas'))->layout(auth()->user()->tema);
    }
}
