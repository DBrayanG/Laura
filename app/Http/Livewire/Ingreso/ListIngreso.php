<?php

namespace App\Http\Livewire\Ingreso;

use Livewire\Component;
use App\Models\Pagina;
use Livewire\WithPagination;
use App\Models\Ingreso;

class ListIngreso extends Component
{
    use WithPagination;
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $layout;

    public function mount()
    {
        Pagina::UpdateVisita('ingreso.list');
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
        return redirect()->route('ingreso.show', $id);
    }

    public function delete($id)
    {
        if (Ingreso::DeleteIngreso($id)) {
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
        $ingresos = Ingreso::GetAllIngresos();
        $visitas = Pagina::GetPagina('ingreso.list') ?? 0;
        return view('livewire.ingreso.list-ingreso', compact('ingresos', 'visitas'))->layout($this->layout);
    }
}
