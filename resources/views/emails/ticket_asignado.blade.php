
{{-- Cuando le asigna un Ticket a un Agente --}}

@extends('emails.layouts.email_stratecsa')

@section('message')
<p style="text-align: justify;">
    Se te ha asignado un nuevo ticket con el número {{ $ticket->id }}. Aquí está el detalle:
</p>
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
        <p style="text-align: justify;">
            Por favor, toma las medidas necesarias para atender este ticket lo antes posible.
        </p>
    </div>
@endsection
