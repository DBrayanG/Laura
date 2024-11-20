<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;

class AcercaDe extends Component
{
    public function render()
    {
        return view('livewire.public.acerca-de')->layout('layouts.public', ['fondo' => false]);
    }
}
