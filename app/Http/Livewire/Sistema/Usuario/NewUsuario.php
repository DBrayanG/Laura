<?php

namespace App\Http\Livewire\Sistema\Usuario;

use App\Models\Pagina;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class NewUsuario extends Component
{
    public $userArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public $roles = [];
    public $areas = [
        "Almacenista",
        "Vendedor",
        "Administracion",
    ];

    public function mount()
    {
        Pagina::UpdateVisita('usuario.new');
        $this->layout = auth()->user()->tema;
        $this->userArray = [
            'name' => '',
            'email' => '',
            'password' => '',
            'cargo' => '',
            'rol' => '',
            'es_cliente' => false,
            'es_personal' => true,
            'es_administrador' => false,
            'telefono' => '',
            'direccion' => '',
        ];
        $this->roles = Role::all();
    }

    public function save()
    {
        if ($this->userArray['rol'] == 1) $this->userArray['es_administrador'] = true;
        if ($this->userArray['rol'] == 4) {
            $this->userArray['es_cliente'] = true;
            $this->userArray['es_personal'] = false;
        }
        $new = User::CreateUsuario($this->userArray);
        $new->assignRole($this->userArray['rol']);
        if (!$new) {
            $this->message = 'Error al crear el usuario';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('usuario.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('usuario.new');
        return view('livewire.sistema.usuario.new-usuario', compact('visitas'))->layout($this->layout);
    }
}
