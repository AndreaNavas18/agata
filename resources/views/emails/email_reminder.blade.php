{{-- Cuando le asigna un Ticket a un Agente --}}

@extends('emails.layouts.email_stratecsa')

@section('message')
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">


        <p style="text-align: justify;">
            Se ha encontrado un ticket que requiere de tu atención.
        </p>
        <p>A continuación los detalles:</p>
    </div>
@endsection



@section('content')
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:left;mso-line-height-alt:24px;">

        <p style="margin: 0; margin-bottom: 16px;">
            <span><b>Prioridad: {{ isset($ticket->priority) ? ucfirst(strtolower($ticket->priority->name)) : 'N/A' }}
                </b></span>
            {{-- {{ isset($ticket->service->installation_type) ? $ticket->service->installation_type : 'N/A' }} --}}
        </p>

        <p style="margin: 0; margin-bottom: 16px;">
            <span><b>Cliente: </b></span>
            {{ isset($ticket->customer) ?  $ticket->customer->name : 'N/A' }}
        </p>

        <p style="margin: 0; margin-bottom: 16px;">
            <span><b>Número de ticket o consecutivo:</b></span>
            {{ isset($ticket->consecutive) ? $ticket->consecutive : 'N/A' }}
        </p>

        <p style="margin: 0; margin-bottom: 16px;">
            <span><b>Asunto:</b></span>
            {{ isset($ticket->ticket_issue) ?  ucfirst(strtolower($ticket->ticket_issue)) : 'N/A' }}
        </p>

        <p style="margin: 0; margin-bottom: 16px;">
            <span><b>Descripción del ticket:</b></span>
            {{ isset($ticket->description) ? ucfirst(strtolower(strip_tags($ticket->description))) : 'N/A' }}
        </p>

        {{-- <div class="div-datos">
            <span><b>Agente asignado:</b></span>
            {{ isset($ticket->employee->short_name) ? $ticket->employee->short_name : 'No hay un agente asignado aún' }}
        </div> --}}
    </div>

    <div 
    style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:left;mso-line-height-alt:24px;">

        <p style="margin: 0; margin-bottom: 16px;">
            Por favor, toma las medidas necesarias para atender este ticket lo antes posible.
        </p>
    </div>
@endsection
