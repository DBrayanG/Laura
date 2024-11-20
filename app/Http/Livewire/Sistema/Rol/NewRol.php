<?php

namespace App\Http\Livewire\Sistema\Rol;

use App\Models\Pagina;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class NewRol extends Component
{
    public $name;
    public $permisosSeleccionados = [];
    public $validate = [
        'name' => 'required|unique:roles,name',
        'permisosSeleccionados' => 'required|array|min:1'
    ];

    public $messages = [
        'name.required' => 'El campo nombre es requerido',
        'name.unique' => 'El nombre ya existe',
        'permisosSeleccionados.required' => 'Debe seleccionar al menos un permiso',
        'permisosSeleccionados.array' => 'Debe seleccionar al menos un permiso',
        'permisosSeleccionados.min' => 'Debe seleccionar al menos un permiso'
    ];

    public function mount()
    {
        Pagina::UpdateVisita('rol.new');
    }

    public function save()
    {
        $this->validate($this->validate, $this->messages);
        $rol = Role::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);
        $rol->syncPermissions($this->permisosSeleccionados);
        return redirect()->route('rol.list');
    }

    public function render()
    {
        $permisos = Permission::all();
        $visitas = Pagina::GetPagina('rol.new');
        return view('livewire.sistema.rol.new-rol', compact('permisos', 'visitas'))->layout(auth()->user()->tema);
    }
}
