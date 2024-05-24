<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pqrs\Pqr;


class pqrAsignacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pqr;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pqr)
    {
        $this->pqr = $pqr;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            to: 'soportestratecsa@stratecsa.cloud',
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
            view: 'emails/pqr_asignacion',
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
        $subject = 'Se le ha asignado un PQR';

        $mail = $this->subject($subject)
        ->view('emails/pqr_asignacion')
        ->from('soportestratecsa@stratecsa.cloud', 'Stratecsa')
        ->with([
            'pqr' => $this->pqr,
        ]);
    
        return $mail;
    }
    
}
