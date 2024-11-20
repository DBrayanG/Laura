<?php

namespace App\Http\Livewire\Salida;

use Livewire\Component;
use App\Models\User;
use App\Models\Salida;
use App\Models\Pagina;
use Illuminate\Support\Facades\Date;

class NewSalida extends Component
{
    public $salidaArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public function mount()
    {
        Pagina::UpdateVisita('salida.new');
        $this->layout = auth()->user()->tema;
    }

    public function save()
    {
        $new = Salida::CreateSalida($this->salidaArray);
        if (!$new) {
            $this->message = 'Error al crear la salida';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('salida.show', $new->id);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('salida.new');
        return view('livewire.salida.new-salida', compact('visitas'))->layout($this->layout);
    }
}
