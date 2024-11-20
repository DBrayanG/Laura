<?php

namespace App\Listeners;

use App\Models\Bitacora;
use App\Models\InicioSesiones;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        InicioSesiones::CreateSesion([
            "fecha" => date('Y-m-d'),
            "hora" => date('H:i:s'),
            "ip" => request()->ip(),
            "usuario_id" => $event->user->id,
        ]);
    }
}
