@extends('emails.layouts.email_stratecsa')

@section('message')
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">
        <p style="margin: 0;">

            Estimado cliente, se le informa que una nueva respuesta se ha registrado para darle continuacion a el ticket
            {{ $ticket->consecutive }}, a continuacion los detalles.

        </p>
    </div>

@endsection


@section('content')
    <div style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:left;mso-line-height-alt:24px;">

        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Asunto:</strong>
            {{ isset($ticket->ticket_issue) ?  ucfirst(strtolower($ticket->ticket_issue)) : 'N/A' }}
        </p>


        {{-- DESCRIPCION --}}
        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Descripción del ticket:</strong>
            {{ isset($ticket->description) ? ucfirst(strtolower(strip_tags($ticket->description))) : 'N/A' }}
        </p>

        
        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Estado tickect:</strong>
            <span class="badge {{ $ticket->state == 'Abierto' ? 'bg-danger' : 'bg-success' }} rounded-pill">
                {{ ucfirst(strtolower( $ticket->state)) }}
            </span>
        </p>

        
        {{-- DATE --}}
        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Fecha:</strong>
            {{ isset($ticket->date) ? $ticket->date : 'N/A' }}
        </p>
        

        <p style="margin: 0;">
            <strong>Respuesta:</strong>
                    {{-- {{ $ticketReply->replie  }} --}}

            {{-- {{ isset($ticket->replies) ? ucfirst(strtolower( $ticket->replies->replie)) : 'N/A' }} --}}
        </p>

        <div class="div-datos">
            <span><b>Respuesta:</b></span>
            
            {{ isset($lastReply->replie) ? $lastReply->replie : 'N/A' }}
        </div>


    </div>

@endsection




