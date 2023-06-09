<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdministradorCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $usuarios;

    /**
     * Create a new message instance.
     */
    public function __construct($usuarios)
    {
        //Recibe un arreglo con la información de la cantidad de usuarios por país 
        $this->usuarios = $usuarios;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            //Asunto del correo
            subject: 'Reporte de usuarios',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            //Se enlaza con la vista de correo adecuada
            view: 'emails.AdministradorEmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
