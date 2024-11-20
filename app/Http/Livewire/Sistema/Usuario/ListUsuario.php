<?php

namespace App\Http\Livewire\Sistema\Usuario;

use App\Models\Pagina;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsuario extends Component
{
    use WithPagination;
    public $search = '';
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $layout;

    public function mount()
    {
        Pagina::UpdateVisita('usuario.list');
        $this->layout = auth()->user()->tema;
    }

    public function toggleNotificacion()
    {
        $this->notificacion = !$this->notificacion;
        $this->emit('notificacion');
    }

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        if (User::DeleteUsuario($id)) {
            $this->message = 'Eliminado correctamente';
            $this->type = 'success';
        } else {
            $this->message = 'Error al eliminar';
            $this->type = 'error';
        }
        $this->notificacion = true;
    }

    public function render()
    {
        $users = User::GetUsuarios($this->search, 'ASC', 20);
        $visitas = Pagina::GetPagina('usuario.list') ?? 0;
        return view('livewire.sistema.usuario.list-usuario', compact('users', 'visitas'))->layout($this->layout);
    }
}
