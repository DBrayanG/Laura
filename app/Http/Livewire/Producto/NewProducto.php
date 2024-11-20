<?php

namespace App\Http\Livewire\Producto;

use App\Models\Pagina;
use Livewire\Component;
use App\Models\Producto;

class NewProducto extends Component
{
    public $productoArray = [];
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;
    public $notificacion = false;

    public function mount()
    {
        Pagina::UpdateVisita('producto.new');
    }

    public function save()
    {
        $new = Producto::CreateProducto($this->productoArray);
        if (!$new) {
            $this->message = 'Error al crear el producto';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('producto.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('producto.new') ?? 0;
        return view('livewire.producto.new-producto', compact('visitas'))->layout(auth()->user()->tema);
    }
}
