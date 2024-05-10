@extends('emails.layouts.email_stratecsa')

@section('message')
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">
        <p style="margin: 0;">Estimado {{$ticket->customer->name}}, le informamos que en base a su
            solicitud se ha creado un ticket. Estamos
            trabajando para atender su requerimiento, nos
            comunicaremos con usted pronto.</p> <br>
    </div>

    <div
    style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
    <p style="margin: 0;">A continuación los detalles.
    </p>

</div>
@endsection

@section('content')
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:left;mso-line-height-alt:24px;">
        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Asunto:</strong>
            {{ isset($ticket->ticket_issue) ?  ucfirst(strtolower($ticket->ticket_issue)) : 'N/A' }}
        </p>

        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Descripción del ticket:</strong>
            {{ isset($ticket->description) ? ucfirst(strtolower(strip_tags($ticket->description))) : 'N/A' }}
        </p>

        @if ($ticket->service->proyecto)
        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Proyecto:</strong>
            {{$ticket->service->proyecto->name}}
        </p> 
        @endif
       

        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Servicio:</strong>
            {{ isset($ticket->service) ? $ticket->service->description : 'N/A' }}

        </p>

        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Numero de ticket o consecutivo:</strong>
            {{ isset($ticket->consecutive) ? $ticket->consecutive : 'N/A' }}
        </p>

        <p style="margin: 0; margin-bottom: 16px;">
            <strong>Fecha:</strong>
            {{ isset($ticket->date) ? $ticket->date : 'N/A' }}
        </p>


    </div>
@endsection









