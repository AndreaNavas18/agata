@extends('emails.layouts.email_stratecsa')

@section('message')
<p style="
padding-top: 20px;
">
 {{-- Nueva respuesta a tickect Stratecsa, consecutivo --}}
 {{-- <span style="background-color: #c9fdc4">{{  $ticket->id }}</span> 🎉 --}}
 Estimado cliente, se le informa que una nueva respuesta se ha registrado para darle continuacion a el ticket
 {{ $ticket->consecutive }}, a continuacion los detalles.
</p>
{{-- <p> --}}
{{-- El agente de soporte {{ $ticketReply->employee->short_name }} ha enviado la siguiente respuesta:<br> --}}
{{-- El departamento de STRATECSA ha enviado la siguiente respuesta:<br> --}}

{{-- {{ $ticketReply->replie  }} --}}
{{-- </p> --}}

@endsection


@section('content')

    <div style="
        color: black;
        padding: 20px 50px;
        padding-bottom: 30px;">

        <div class="div-datos">
            <span><b>Asunto:</b></span>
            {{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}
        </div>

        <div class="div-datos">
            <span><b>Motivo de solicitud:</b></span>
            {{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}
        </div>

        <div class="div-datos">
            <b>Estado tickect:</b>
            <span class="badge {{ $ticket->state == 'Abierto' ? 'bg-danger' : 'bg-success' }} rounded-pill">
                {{ $ticket->state }}
            </span>
        </div>

    </div>


    {{-- <p>
        <b>Prioridad tickect:</b>
        <span class="badge {{ $ticket->priority->color }} rounded-pill">
            {{ $ticket->priority->name }}
        </span>
    </p> --}}
@endsection
