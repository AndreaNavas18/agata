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

    protected $ticketVisit;
    protected $archivosAdjuntos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TicketVisit $ticketVisit, $archivosAdjuntos)
    {
        //
        $this->ticketVisit = $ticketVisit;
        $this->archivosAdjuntos = $archivosAdjuntos;
       
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            to: 'plataformaagata@sratecsa.cloud',
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
            view: 'emails/tickect_new',
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
        ->from('stratecsa@outlook.es', 'Stratecsa')
        ->with([
            'ticketVisit' => $this->ticketVisit,
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