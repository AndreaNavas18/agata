<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class webCorreo extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre;
    public $empresa;
    public $pais;
    public $provincia;
    public $telefono;
    public $correo;
    public $asunto;
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $empresa, $pais, $provincia, $telefono, $correo, $asunto, $mensaje)
    {
        $this->nombre = $nombre;
        $this->empresa = $empresa;
        $this->pais = $pais;
        $this->provincia = $provincia;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Andrea Navas',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.new_ticket',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails/web_correo')
                    ->subject('Contacto por pagina web')
                    ->with([
                        'nombre' => $this->nombre,
                        'empresa' => $this->empresa,
                        'pais' => $this->pais,
                        'provincia' => $this->provincia,
                        'telefono' => $this->telefono,
                        'correo' => $this->correo,
                        'asunto' => $this->asunto,
                        'mensaje' => $this->mensaje
                    ])
                    ->from('soportestratecsa@stratecsa.cloud', 'Stratecsa');
    }
}
