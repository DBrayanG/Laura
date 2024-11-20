<?php

namespace App\Http\Livewire\Compra;

use Livewire\Component;
use App\Models\User;
use App\Models\Compra;
use App\Models\Pagina;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Date;

class NewCompra extends Component
{
    public $compraArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public $proveedores = [];

    public function mount()
    {
        Pagina::UpdateVisita('compra.new');
        $this->layout = auth()->user()->tema;
        $this->proveedores = Proveedor::GetAllProveedores();
        // $this->productos = Producto::all();
    }

    public function save()
    {
        $new = Compra::CreateCompra($this->compraArray);
        if (!$new) {
            $this->message = 'Error al crear la compra';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('compra.show', $new->id);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('compra.new');
        return view('livewire.compra.new-compra',compact('visitas'))->layout($this->layout);
    }
}
