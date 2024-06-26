<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Tickets\Ticket;


class TicketAsignado extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        //
        $this->ticket = $ticket;
       
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
            view: 'emails/ticket_asignado',
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
        $subject = 'Asignación de ticket' . $this->ticket->consecutive;

        $mail = $this->subject($subject)
        ->view('emails/ticket_asignado')
        ->from('soportestratecsa@stratecsa.cloud', 'Stratecsa')
        ->with([
            'ticket' => $this->ticket,
        ]);
    
        return $mail;
    }
    
}
