<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Tickets\TicketVisit;

class VisitaTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketVisit;
    public $archivosAdjuntos;
    public $employees;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TicketVisit $ticketVisit, $archivosAdjuntos, $employees)
    {
        //
        $this->ticketVisit = $ticketVisit;
        $this->archivosAdjuntos = $archivosAdjuntos;
        $this->employees = $employees;
       
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            to: 'soporte@stratecsa.com',
        );

    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
     {
        return new Content(
            view: 'emails/technical_service',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        // return [];
    }

    public function build()
    {
        $subject = 'Nueva visita técnica para el ticket #' . $this->ticketVisit->ticket_id;

        $mail = $this->subject($subject)
        ->view('emails/ticket_new')
        ->from('soportestratecsa@stratecsa.cloud', 'Stratecsa')
        ->with([
            'ticketVisit' => $this->ticketVisit,
            'employees' => $this->employees,
        ]);

        // Adjuntar cada archivo
        foreach ($this->archivosAdjuntos as $archivoAdjunto) {
            $file = public_path('storage/' . $archivoAdjunto); // Obtener la ruta completa del archivo
            $fileName = basename($file); // Obtener el nombre del archivo
            $mail->attach($file, [
                'as' => $fileName, // Nombre del archivo adjunto
            ]);
        }
    

        return $mail;
    }
    
}