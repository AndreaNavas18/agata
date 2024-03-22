@extends('emails.layouts.email_stratecsa')

@section('message')
    <p style="text-align: justify;">
        Hola equipo de soporte,
    </p style="text-align: justify;">

    <p>Este es un aviso de que hay un ticket de prioridad alta que no ha recibido respuesta:</p>
@endsection



@section('content')
    <div style="
            padding-left: 50px;
            padding-right: 50px;
            color: black;
">

        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Prioridad:</strong>
            {{ isset($ticket->priority) ? ucfirst(strtolower($ticket->priority->name)) : 'N/A' }}
        </p>


        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Cliente:</strong>
            {{ isset($ticket->customer) ?$ticket->customer->name : 'N/A' }}
        </p>


        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Numero de ticket o consecutivo:</strong>
            {{ isset($ticket->consecutive) ? $ticket->consecutive : 'N/A' }}
        </p>


        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Asunto:</strong>
            {{ isset($ticket->ticket_issue) ? ucfirst(strtolower($ticket->ticket_issue)) : 'N/A' }}
        </p>

        {{-- DESCRIPCION --}}
        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Descripción del ticket:</strong>
            {{ isset($ticket->description) ? ucfirst(strtolower(strip_tags($ticket->description))) : 'N/A' }}
        </p>

        {{-- <div class="div-datos">
            <span><b>Agente asignado:</b></span>
            {{ isset($ticket->employee->short_name) ? $ticket->employee->short_name : 'No hay un agente asignado aún' }}
        </div> --}}
    </div>

    <div>
        <p>Por favor, tomen las medidas necesarias para abordar este ticket lo antes posible.</p>
    </div>
@endsection
