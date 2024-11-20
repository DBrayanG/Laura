<?php

namespace App\Http\Livewire\Public;

use App\Models\Pagina;
use Livewire\Component;

class Contacto extends Component
{
    public function mount()
    {
        Pagina::UpdateVisita('public.contacto');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('public.contacto') ?? 0;
        return view('livewire.public.contacto', compact('visitas'))->layout('layouts.public', ['fondo' => false]);
    }
}
