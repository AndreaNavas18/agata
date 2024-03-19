@extends('emails.layouts.email_stratecsa')


@section('message')
<div style="
    padding: 15px 0px;
" 
 >

    <p style="">
        Se ha registrado una nueva respuesta de un cliente
        <span style="background-color: #c9fdc4">{{  $ticket->id }}</span> 🎉
    </p>
    <p>
        {{-- El agente de soporte {{ $ticketReply->employee->short_name }} ha enviado la siguiente respuesta:<br> --}}
        El cliente TAL ha enviado la siguiente respuesta:<br>
        
        {{-- {{ $ticketReply->replie  }} --}}
    </p>
</div>
    
@endsection


 @section('content')
 <div style="
 color: black;
 padding: 20px 50px;
 padding-bottom: 55px;">

<div class="div-datos">
    <b>Estado tickect:</b>
    <span class="badge {{ $ticket->state=='Abierto' ? 'bg-danger' : 'bg-success' }} rounded-pill">
        {{ $ticket->state }}
    </span>

</div>
    <div class="div-datos">
    <b>Prioridad tickect:</b>
    <span class="badge {{ $ticket->priority->color }} rounded-pill">
        {{ $ticket->priority->name }}
    </span>
</div>


</div>
@endsection
