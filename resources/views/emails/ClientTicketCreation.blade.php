@extends('layouts.email')

@section('information')

<div style="
        padding-top: 20px;
        padding-bottom: 15px;">
        
    <p style="text-align: justify;">
        Estimado cliente, su ticket {{$ticket->consecutive}} ha sido creado para responder a su solicitud {{$ticket->ticket_issue }} del servicio {{$ticket->service->description}}. Estamos trabajando para atender su requerimiento y comunicarnos pronto.

    </p>
    <p style="text-align: justify;">Gracias por hacer uso de nuestra plataforma.</p>
</div>

@endsection

@section('content')
    {{-- <div
        style="
            color: black;
            padding: 20px 50px;
">

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

    </div> --}}
@endsection


