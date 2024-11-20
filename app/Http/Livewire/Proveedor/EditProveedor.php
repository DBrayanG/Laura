<?php

namespace App\Http\Livewire\Proveedor;

use Livewire\Component;
use App\Models\Pagina;
use App\Models\Proveedor;

class EditProveedor extends Component
{
    public $proveedorArray = [];
    public $type;
    public $message = 'Editado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;
    public $notificacion = false;
    public $proveedor;

    public function mount($proveedor)
    {
        $this->proveedor = Proveedor::GetProveedor($proveedor);
        $this->proveedorArray = ['nombre', $this->proveedor->nombre];
        Pagina::UpdateVisita('proveedor.edit');
    }

    public function save()
    {
        $new = Proveedor::UpdateProveedor($this->proveedor->id, $this->proveedorArray);
        if (!$new) {
            $this->message = 'Error al editar el proveedor';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('proveedor.list');
    }
    public function render()
    {
        $visitas = Pagina::GetPagina('proveedor.edit') ?? 0;
        return view('livewire.proveedor.edit-proveedor', compact('visitas'))->layout(auth()->user()->tema);
    }
}
