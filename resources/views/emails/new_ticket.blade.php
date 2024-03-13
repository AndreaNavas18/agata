@extends('layouts.email')


@section('message')
    <p style="font-size: 20px;margin-bottom: 40px; color: black;">
        Le informamos que hemos registrado su solicitud como un nuevo ticket de soporte. Estamos trabajando para atender su
        requerimiento y nos comunicaremos con usted pronto. A continuación, encontrará los detalles correspondientes.
    </p>
@endsection


@section('content')
    <div
        style="
    font-size: medium;
    padding-left: 50px;
    padding-right: 50px;
    padding-top: 165px;
    width: 65%;
    height: 100%;
    color: black;
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
            {{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}</td>
        </div>

        <div>
            <span><b>Agente:</b></span>
            {{ isset($ticket->employee->short_name) ? $ticket->employee->short_name : 'N/A' }}</td>
        </div>

        <div style="margin: 0 auto;  padding-top: 20px; position: relative;
            top: 144px; left: 34%;">
            <button
                style="
                text-align: left;
                background-color: blue;
                border-radius: 15px;
                height: 30px;
                color: white;
                border: none; 
                cursor: pointer; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                text-decoration: none; ">
                <a href="https://www.stratecsa.com/"
                    style="
            color: inherit; /* Hereda el color del texto del botón */
            text-decoration: none; /* Quita el subrayado */
        ">Para
                    más información</a></button>

        </div>
    </div>
@endsection
