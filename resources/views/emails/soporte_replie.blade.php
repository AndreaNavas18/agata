@extends('emails.layouts.email_stratecsa')


@section('message')
<div 
style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">
<p style="margin: 0;">
        Se ha registrado una nueva respuesta de un cliente
    </p><br>

    <p style="margin: 0;">
        {{-- El agente de soporte {{ $ticketReply->employee->short_name }} ha enviado la siguiente respuesta:<br> --}}
        El cliente TAL ha enviado la siguiente respuesta:<br>
        
        {{-- {{ $ticketReply->replie  }} --}}
    </p>
</div>
    
@endsection


 @section('content')
 <div style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:left;mso-line-height-alt:24px;">

    <p style="margin: 0; margin-bottom: 16px;">
        <strong>Estado tickect:</strong>
        <span class="badge {{  $ticket->state=='Abierto' ? 'bg-danger' : 'bg-success' }} rounded-pill">
            {{  ucfirst(strtolower($ticket->state)) }}
        </span>
    </p>

    <p style="margin: 0; margin-bottom: 16px;">
        <strong>Prioridad tickect:</strong>
        <span class="badge {{ $ticket->priority->color }} rounded-pill">
            {{  ucfirst(strtolower($ticket->priority->name)) }}
        </span>
    </p>

</div>
@endsection
