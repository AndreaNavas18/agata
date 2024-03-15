@extends('layouts.email')

@section('information')
<p style="text-align: justify;">
    Le informamos que hemos registrado su solicitud como un nuevo ticket. Estamos trabajando para atender su requerimiento y nos comunicaremos con usted pronto.
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
            <span><b>Tipo instalación:</b></span>
            {{ isset($ticket->service->installation_type) ? $ticket->service->installation_type : 'N/A' }}
        </div>

        <div class="div-datos">
            <span><b>Tipo servicio:</b></span>
            {{ isset($ticket->service->service->name) ? $ticket->service->service->name : 'N/A' }}
        </div>

        <div class="div-datos">
            <span><b>Descripción servicio:</b></span>
            {{ isset($ticket->service->description) ? $ticket->service->description : 'N/A' }}
        </div>

        <div class="div-datos">
            <span><b>Asunto:</b></span>
            {{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}
        </div>

        <div class="div-datos">
            <span><b>Agente:</b></span>
            {{ isset($ticket->employee->short_name) ? $ticket->employee->short_name : 'N/A' }}
        </div>

        {{-- <div style="
            padding-top: 80px;
            margin-left: 30%;">
            <button
                style="
                text-align: center;
                        background-color: #2196f3;
                        border-radius: 15px;
                        height: 30px;
                        color: white;
                        border: solid 1px white;
                        width: 180px;">
                <a href="https://www.stratecsa.com/"
                    style="
            color: inherit; /* Hereda el color del texto del botón */
            text-decoration: none; /* Quita el subrayado */
        ">Para más información</a></button>
        CAMBIO PARA STAGED
        </div> --}}
    </div>
@endsection
