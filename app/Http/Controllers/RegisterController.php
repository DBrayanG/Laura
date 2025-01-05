<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class RegisterController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function register()
    {
        return view('auth.registrar');
    }

    public function store()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El correo es requerido',
            'email.unique' => 'El correo ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'telefono.required' => 'El telefono es requerido',
            'direccion.required' => 'La direccion es requerida', 
        ];

        $this->validate(request(), $rules, $messages);
        $data = request()->all();
        $data['password'] = bcrypt($data['password']);
        $data['es_cliente'] = true;
        $user = User::create($data);
        auth()->login($user);
        return redirect()->route('inicio');
    }
}
