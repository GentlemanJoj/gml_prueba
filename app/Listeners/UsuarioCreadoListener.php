<?php

namespace App\Listeners;

use App\Http\Controllers\UsuarioController;
use App\Mail\UsuarioCorreo;
use App\Mail\AdministradorCorreo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

/**
 * Listener que envía correo al usuario y al administrador 
 * cuando el evento UsuarioCreado se lanza
 */
class UsuarioCreadoListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Enviar correo al usuario
     */
    public function enviarCorreoUsuario(object $event): void
    {
        //El event contiene la información del usuario
        Mail::to($event->usuario->email)->send(new UsuarioCorreo($event->usuario->nombre));
    }

    /**
     * Enviar correo al administrador 
     */
    public function enviarCorreoAdministrador()
    {
        //Obtener información de la cantidad de usuarios por país 
        $usuarios = UsuarioController::usuariosPorPais();
        //Obtener el correo del administrador, que se encuentra en la configuración
        $administradorCorreo = env('ADMIN_EMAIL');
        Mail::to($administradorCorreo)->send(new AdministradorCorreo($usuarios));
    }
}
