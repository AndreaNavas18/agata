@extends('layouts.email')
@section('content')
    <p style="
        font-size: 15px;
        font-family: Arial, sans-serif;
        text-align: center;
        font-weight: 900;
        color: #1e4752;
        border: 1px solid #153643;
        border-radius: 1rem;
        padding:20px;
        min-height: 10rem;
        margin-top: -4rem;
        margin-right: -2rem;">
        Nueva respuesta a tickect Stratecsa, consecutivo
        <span style="background-color: #c9fdc4">{{  $ticket->id }}</span> 🎉
    </p>
    <p>
        {{-- El agente de soporte {{ $ticketReply->employee->short_name }} ha enviado la siguiente respuesta:<br> --}}
        El departamento de STRATECSA ha enviado la siguiente respuesta:<br>
        
        {{-- {{ $ticketReply->replie  }} --}}
    </p>
    <p>
        <b>Estado tickect:</b>
        <span class="badge {{ $ticket->state=='Abierto' ? 'bg-danger' : 'bg-success' }} rounded-pill">
            {{ $ticket->state }}
        </span>
    </p>
    <p>
        <b>Prioridad tickect:</b>
        <span class="badge {{ $ticket->priority->color }} rounded-pill">
            {{ $ticket->priority->name }}
        </span>
    </p>
@endsection
