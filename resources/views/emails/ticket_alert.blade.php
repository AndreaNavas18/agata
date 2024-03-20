@extends('emails.layouts.email_stratecsa')

@section('message')
<p style="text-align: justify;">
    Hola equipo de soporte,
</p style="text-align: justify;">

<p>Este es un aviso de que hay un ticket de prioridad alta que no ha recibido respuesta:</p>
@endsection



@section('content')
    <div
        style="
            padding-left: 50px;
            padding-right: 50px;
            color: black;
">

        <div class="div-datos">
            <span><b>Prioridad: {{ isset ($ticket->priority) ? $ticket->priority->name : 'N/A' }}   </b></span>
            {{-- {{ isset($ticket->service->installation_type) ? $ticket->service->installation_type : 'N/A' }} --}}
        </div>

        <div class="div-datos">
            <span><b>Cliente: </b></span>
            {{ isset ($ticket->customer) ? $ticket->customer->name : 'N/A' }}
        </div>

        <div class="div-datos">
            <span><b>Numero de ticket o consecutivo:</b></span>
            {{ isset ($ticket->consecutive) ? $ticket->consecutive : 'N/A'}}
        </div>

        <div class="div-datos">
            <span><b>Asunto:</b></span>
            {{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}
        </div>

        <div class="div-datos">
            <span><b>Descripcion del ticket:</b></span>
            {{  isset($ticket->description) ? $ticket->description : 'N/A' }}
        </div>
        
        {{-- <div class="div-datos">
            <span><b>Agente asignado:</b></span>
            {{ isset($ticket->employee->short_name) ? $ticket->employee->short_name : 'No hay un agente asignado aún' }}
        </div> --}}
    </div>

    <div>
        <p>Por favor, tomen las medidas necesarias para abordar este ticket lo antes posible.</p>
    </div>



@endsection
