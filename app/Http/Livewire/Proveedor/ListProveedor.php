<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Pagina;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class ListProveedor extends Component
{
    use WithPagination;
    public $search = '';
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $layout;

    public function mount()
    {
        Pagina::UpdateVisita('proveedor.list');
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
        return redirect()->route('proveedor.edit', $id);
    }

    public function delete($id)
    {
        if (Proveedor::DeleteProveedor($id)) {
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
        $proveedores = Proveedor::GetProveedores($this->search, 'ASC', 20);
        $visitas = Pagina::GetPagina('producto.list') ?? 0;
        return view('livewire.proveedor.list-proveedor', compact('proveedores', 'visitas'))->layout(auth()->user()->tema);
    }
}
