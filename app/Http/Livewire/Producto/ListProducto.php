<?php

namespace App\Http\Livewire\Producto;

use App\Models\Pagina;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;

class ListProducto extends Component
{
    use WithPagination;
    public $search = '';
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $layout;

    public function mount()
    {
        Pagina::UpdateVisita('producto.list');
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
        return redirect()->route('producto.edit', $id);
    }

    public function delete($id)
    {
        if (Producto::DeleteProducto($id)) {
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
        $productos = Producto::GetProductos($this->search, 'ASC', 20);
        $visitas = Pagina::GetPagina('producto.list') ?? 0;
        return view('livewire.producto.list-producto', compact('productos', 'visitas'))->layout(auth()->user()->tema);
    }
}
