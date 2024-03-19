@extends('emails.layouts.email_stratecsa')

@section('message')
<p style="text-align: justify;">
    Estimado cliente, le informamos que en base a su solicitud se ha creado un ticket. Estamos trabajando para atender su requerimiento, nos comunicaremos con usted pronto. 

</p>
<p style="text-align: justify;">
    A continuacion los detalles.
</p>
@endsection

@section('content')
    <div
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

    </div>
@endsection


