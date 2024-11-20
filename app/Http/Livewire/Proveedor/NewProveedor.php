<?php

namespace App\Http\Livewire\Proveedor;

use Livewire\Component;
use App\Models\Pagina;
use App\Models\Proveedor;
class NewProveedor extends Component
{
    public $proveedorArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public function mount(){
        Pagina::UpdateVisita('proveedor.new');      
    }

    public function save(){
        $new = Proveedor::CreateProveedor($this->proveedorArray);
        if(!$new){
            $this->message = 'Error al crear el proveedor';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('proveedor.list');
    }
    public function render()
    {
        $visitas = Pagina::GetPagina('proveedor.new') ?? 0;
        return view('livewire.proveedor.new-proveedor', compact('visitas'))
            ->with('layout', 'layouts.app')
            ->with('section', auth()->user()->tema);
    }
}
