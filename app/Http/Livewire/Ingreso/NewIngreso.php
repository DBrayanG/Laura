<?php

namespace App\Http\Livewire\Ingreso;

use Livewire\Component;
use App\Models\User;
use App\Models\Ingreso;
use App\Models\Pagina;
use Illuminate\Support\Facades\Date;

class NewIngreso extends Component
{

    public $ingresoArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public function mount()
    {
        Pagina::UpdateVisita('ingreso.new');
        $this->layout = auth()->user()->tema;
    }

    public function save()
    {
        $new = Ingreso::CreateIngreso($this->ingresoArray);
        if (!$new) {
            $this->message = 'Error al crear el ingreso';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('ingreso.show', $new->id);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('ingreso.new') ?? 0;
        return view('livewire.ingreso.new-ingreso', compact('visitas'))->layout($this->layout);
    }
}
