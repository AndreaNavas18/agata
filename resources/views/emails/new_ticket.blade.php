@extends('layouts.email')



@section('content')
    <div
        style="
            font-size: medium;
            padding-left: 50px;
            padding-right: 50px;
            color: black;
            position: absolute;
            top: 365px;
">

        <div>
            <span><b>Tipo instalación:</b></span>
            {{ isset($ticket->service->installation_type) ? $ticket->service->installation_type : 'N/A' }}
        </div>

        <div>
            <span><b>Tipo servicio:</b></span>
            {{ isset($ticket->service->service->name) ? $ticket->service->service->name : 'N/A' }}
        </div>

        <div>
            <span><b>Descripción servicio:</b></span>
            {{ isset($ticket->service->description) ? $ticket->service->description : 'N/A' }}
        </div>

        <div>
            <span><b>Asunto:</b></span>
            {{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}
        </div>

        <div>
            <span><b>AGENTECAMBIO:</b></span>
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
