@extends('emails.layouts.email_stratecsa')

@section('message')
    <div style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">
        <p style="text-align: justify;">
            Se han encontrado los siguientes tickets que requieren de tu atención:
        </p>
        <p>A continuación los detalles:</p>
    </div>
@endsection

@section('content')
    @php $counter = 1; @endphp
    @foreach($tickets as $ticket)
        <div style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:left;mso-line-height-alt:24px;">
            <p style="margin: 0; margin-bottom: 16px;">
                <span><b>Ticket número {{ $counter++ }}</b></span>
                {{-- Agrega aquí la prioridad del ticket --}}
            </p>

            {{-- Agrega aquí los detalles del ticket --}}
            <p style="margin: 0; margin-bottom: 16px;">
                <span><b>Prioridad: {{ isset($ticket->priority) ? ucfirst(strtolower($ticket->priority->name)) : 'N/A' }}</b></span>
            </p>

            <p style="margin: 0; margin-bottom: 16px;">
                <span><b>Número de ticket o consecutivo:</b></span>
                {{ isset($ticket->consecutive) ? $ticket->consecutive : 'N/A' }}
            </p>

            <p style="margin: 0; margin-bottom: 16px;">
                <span><b>Asunto:</b></span>
                {{ isset($ticket->ticket_issue) ?  ucfirst(strtolower($ticket->ticket_issue)) : 'N/A' }}
            </p>

            {{-- Agrega aquí cualquier otra información relevante del ticket --}}
        </div>

        {{-- Añade un separador visual entre cada ticket --}}
        <hr style="border-top: 1px solid #ccc; margin-bottom: 20px;">
    @endforeach
@endsection
