<?php

namespace App\Http\Livewire\Producto;

use App\Models\Pagina;
use Livewire\Component;
use App\Models\Producto;

class EditProducto extends Component
{
    public $productoArray = [];
    public $type = 'success';
    public $message = 'Editado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;
    public $notificacion = false;

    public $producto;

    public function mount($producto)
    {
        $this->producto = Producto::GetProducto($producto);
        $this->productoArray = ['nombre', $this->producto->nombre];
        Pagina::UpdateVisita('producto.edit');
    }

    public function save()
    {
        $new = Producto::UpdateProducto($this->producto->id, $this->productoArray);
        if (!$new) {
            $this->message = 'Error al editar el producto';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('producto.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('producto.edit') ?? 0;
        return view('livewire.producto.edit-producto', compact('visitas'))->layout(auth()->user()->tema);
    }
}
