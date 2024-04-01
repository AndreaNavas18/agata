@extends('emails.layouts.email_stratecsa')

@section('message')
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">
        <p style="margin: 0; margin-bottom: 16px;">
            Hola equipo de soporte,
        </p>
        <p style="margin: 0; margin-bottom: 16px;">
            Este es un aviso de que hay un ticket de prioridad alta que no ha recibido respuesta:</p>

    </div>
@endsection



@section('content')
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">

        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Prioridad:</strong>
            {{ isset($ticket->priority) ? ucfirst(strtolower($ticket->priority->name)) : 'N/A' }}
        </p>


        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Cliente:</strong>
            {{ isset($ticket->customer) ? $ticket->customer->name : 'N/A' }}
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

    <br>
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">

        <p>Por favor, tomen las medidas necesarias para abordar este ticket lo antes posible.
        </p>
    </div>
@endsection