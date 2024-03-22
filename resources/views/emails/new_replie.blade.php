@extends('emails.layouts.email_stratecsa')

@section('message')
    <p style="text-align: justify;">
        Estimado {{ $ticket->customer->name }}, le informamos que en base a su solicitud se ha creado un ticket. Estamos
        trabajando para atender su requerimiento, nos comunicaremos con usted pronto.

    </p>
    <p style="text-align: justify;">
        A continuacion los detalles.
    </p>
@endsection

@section('content')
    <div style="
            color: black;
            padding: 20px 50px;
">

        <div class="div-datos">
            <span><b>Asunto:</b></span>
            {{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}
        </div>
        

        {{-- MOTIVO SOLICITUD --}}
        <div class="div-datos">
            <span><b>Motivo de Solicitud: </b></span>
            {{-- {{ isset ($ticket->customer) ? $ticket->customer->name : 'N/A' }} --}}
        </div>


        {{-- DESCRIPCIÓN --}}
        <div class="div-datos">
            <span><b>Descripcion del ticket:</b></span>
            {{ isset($ticket->description) ? strip_tags($ticket->description) : 'N/A' }}
        </div>

        {{-- IF EXISTE UN PROYECTO (EL PROYECTO) --}}

        <div class="div-datos">
            <span><b>Proyecto: </b></span>
            {{-- {{ isset ($ticket->customer) ? $ticket->customer->name : 'N/A' }} --}}
        </div>


        {{-- SERVICIOS --}}

        <div class="div-datos">
            <span><b>Servicio:</b></span>
            {{ isset($ticket->service) ? $ticket->service->description : 'N/A' }}
        </div>



        <div class="div-datos">
            <span><b>Numero de ticket o consecutivo:</b></span>
            {{ isset($ticket->consecutive) ? $ticket->consecutive : 'N/A' }}
        </div>

        {{-- FECHA --}}
        <div class="div-datos">
            <span><b>Fecha:</b></span>
            {{ isset($ticket->created_at) ? $ticket->date : 'N/A' }}
        </div>

        <div class="div-datos">
            <span><b>Respuesta:</b></span>
            
            {{ isset($lastReply->replie) ? $lastReply->replie : 'N/A' }}
        </div>


    </div>
@endsection
