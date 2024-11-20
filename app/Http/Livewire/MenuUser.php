<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class MenuUser extends Component
{
    public $temaActual;
    public $temas = [
        [
            "label" => "Niño",
            "value" => "layouts.niño",
        ],
        [
            "label" => "Joven",
            "value" => "layouts.joven",
        ],
        [
            "label" => "Adulto",
            "value" => "layouts.adulto",
        ],
    ];

    public function mount()
    {
        $this->temaActual = auth()->user()->tema ?? 'layouts.joven';
    }

    public function cambiarTema($tema)
    {
        User::cambiarTema(auth()->user()->id, $tema);
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.menu-user');
    }
}
