<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Tickets\Ticket;


class ReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $tickets;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tickets)
    {
        //
        $this->tickets = $tickets;
       
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
            view: 'emails/email_reminder',
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
        $subject = 'Se encontraron tickets sin respuesta';

        $mail = $this->subject($subject)
        ->view('emails/email_reminder')
        ->from('soportestratecsa@stratecsa.cloud', 'Stratecsa')
        ->with([
            'tickets' => $this->tickets,
        ]);
    
        return $mail;
    }
    
}
