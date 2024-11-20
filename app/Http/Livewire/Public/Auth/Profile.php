<?php

namespace App\Http\Livewire\Public\Auth;

use App\Models\Pagina;
use Livewire\Component;

class Profile extends Component
{
    public function mount()
    {
        Pagina::UpdateVisita('public.perfil');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('public.perfil') ?? 0;
        return view('livewire.public.auth.profile', compact('visitas'))->layout('layouts.public', ['fondo' => false]);
    }
}
