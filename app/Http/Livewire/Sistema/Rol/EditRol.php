<?php

namespace App\Http\Livewire\Sistema\Rol;

use App\Models\Pagina;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRol extends Component
{
    public $rol;
    public $name;
    public $permisosSeleccionados = [];
    public $arrayPermisos = [];

    public $messages = [
        'name.required' => 'El campo nombre es requerido',
        'name.unique' => 'El nombre ya existe',
        'permisosSeleccionados.required' => 'Debe seleccionar al menos un permiso',
        'permisosSeleccionados.array' => 'Debe seleccionar al menos un permiso',
        'permisosSeleccionados.min' => 'Debe seleccionar al menos un permiso'
    ];

    public function mount($rol)
    {
        Pagina::UpdateVisita('rol.edit');
        $this->rol = Role::find($rol);
        $this->name = $this->rol->name;
        $this->arrayPermisos = $this->rol->getAllPermissions()->pluck('id')->toArray();
        foreach ($this->arrayPermisos as $permiso) {
            $this->permisosSeleccionados[$permiso] = $permiso;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->rol->id,
            'permisosSeleccionados' => 'required|array|min:1'
        ], $this->messages);
        $this->rol->name = $this->name;
        $this->rol->syncPermissions($this->permisosSeleccionados);
        $this->rol->save();
        return redirect()->route('rol.list');
    }

    public function render()
    {
        $permisos = Permission::all();
        $visitas = Pagina::GetPagina('rol.edit');
        return view('livewire.sistema.rol.edit-rol', compact('permisos', 'visitas'))->layout(auth()->user()->tema);
    }
}
