<?php

namespace App\Http\Livewire\SalidaDetalle;

use App\Models\Pagina;
use Livewire\Component;
use App\Models\Salida;
use App\Models\SalidaDetalle;
use App\Models\Producto;


class NewSalidaDetalle extends Component
{
    public $detalleArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;
    public $salida_id;

    public $productos = [];

    public function mount($id)
    {
        $this->layout = auth()->user()->tema;
        $this->productos = Producto::GetAllProductos();
        $this->salida_id = $id;
        $this->detalleArray = ['salida_id' => $id];
        Pagina::UpdateVisita('salida-detalle.new');
    }

    public function save()
    {
        $new = SalidaDetalle::CreateSalidaDetalle($this->detalleArray);
        if (!$new) {
            $this->message = 'Error al añadir el detalle';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('salida.show', $this->salida_id);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('salida-detalle.new') ?? 0;
        return view('livewire.salida-detalle.new-salida-detalle', compact('visitas'))->layout(auth()->user()->tema);
    }
}
