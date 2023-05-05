<?php

namespace App\Listeners;

use App\Http\Controllers\UsuarioController;
use App\Mail\UsuarioCorreo;
use App\Mail\AdministradorCorreo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
     * Handle the event.
     */
    public function enviarCorreoUsuario(object $event): void
    {
        //Enviar correo al usuario
        Mail::to($event->usuario->email)->send(new UsuarioCorreo($event->usuario->nombre));
    }

    public function enviarCorreoAdministrador()
    {
        //Enviar correo al administrador con el reporte 
        $usuarios = UsuarioController::usuariosPorPais();
        $administradorCorreo = env('ADMIN_EMAIL');
        Mail::to($administradorCorreo)->send(new AdministradorCorreo($usuarios));
    }
}
