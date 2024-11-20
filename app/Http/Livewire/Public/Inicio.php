<?php

namespace App\Http\Livewire\Public;

use App\Models\Pagina;
use Livewire\Component;

class Inicio extends Component
{
    public function mount()
    {
        Pagina::UpdateVisita('inicio');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('inicio') ?? 0;
        return view('livewire.public.inicio', compact('visitas'))->layout('layouts.public', ['fondo' => true]);
    }
}
