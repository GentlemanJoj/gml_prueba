<?php

namespace App\Providers;

use App\Events\UsuarioCreado;
use App\Listeners\UsuarioCreadoListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //El listener realiza 2 métodos, ambos cuando el evento UsuarioCreado es lanzado 
        Event::listen(UsuarioCreado::class, [UsuarioCreadoListener::class, 'enviarCorreoUsuario']);
        Event::listen(UsuarioCreado::class, [UsuarioCreadoListener::class, 'enviarCorreoAdministrador']);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
