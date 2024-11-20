<?php

namespace App\Http\Livewire\Salida;

use Livewire\Component;
use App\Models\Proveedor;
use App\Models\Pagina;
use Livewire\WithPagination;
use App\Models\Salida;

class ListSalida extends Component
{
    use WithPagination;
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $layout;

    public function mount()
    {
        Pagina::UpdateVisita('salida.list');
        $this->layout = auth()->user()->tema;
    }

    public function toggleNotificacion()
    {
        $this->notificacion = !$this->notificacion;
        $this->emit('notificacion');
    }

    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        return redirect()->route('salida.show', $id);
    }

    public function delete($id)
    {
        if (Salida::DeleteSalida($id)) {
            $this->message = 'Eliminado correctamente';
            $this->type = 'success';
        } else {
            $this->message = 'Error al eliminar';
            $this->type = 'error';
        }
        $this->notificacion = true;
    }

    public function render()
    {
        $salidas = Salida::GetAllSalidas();
        $visitas = Pagina::GetPagina('salida.list') ?? 0;
        return view('livewire.salida.list-salida', compact('salidas', 'visitas'))->layout($this->layout);
    }
}
