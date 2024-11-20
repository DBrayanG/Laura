<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tema',
        "direccion",
        "telefono",
        "cargo",
        "es_cliente",
        "es_personal",
        "es_administrador",
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];


    // Funciones
    static public function CreateUsuario(array $data)
    {
        $new = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'direccion' => $data['direccion'] ?? '',
            'telefono' => $data['telefono'] ?? '',
            'cargo' => $data['cargo'] ?? '',
            'es_cliente' => $data['es_cliente'] ?? false,
            'es_personal' => $data['es_personal'] ?? false,
            'es_administrador' => $data['es_administrador'] ?? false,
        ]);
        return $new;
    }

    static public function UpdateUsuario($id, array $data)
    {
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->area = $data['area'];
        $user->password = bcrypt($data['password']);
        $user->direccion = $data['direccion'] ?? '';
        $user->telefono = $data['telefono'] ?? '';
        $user->cargo = $data['cargo'] ?? '';
        $user->es_cliente = $data['es_cliente'] ?? false;
        $user->es_personal = $data['es_personal'] ?? false;
        $user->es_administrador = $data['es_administrador'] ?? false;
        $user->save();
        return $user;
    }

    static public function DeleteUsuario($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }

    static public function GetUsuarios($attribute, $order = "desc", $paginate)
    {
        $users = User::where('name', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('email', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $users;
    }

    static public function GetAllUsuarios()
    {
        $users = User::all();
        return $users;
    }

    static public function GetUsuario($id)
    {
        $user = User::find($id);
        return $user;
    }

    static public function cambiarTema(int $id, string $tema)
    {
        $user = User::find($id);
        $user->tema = $tema;
        $user->save();
        return $user;
    }

    static public function GetClientes()
    {
        $users = User::where('es_cliente', true)->get();
        return count($users);
    }
}
