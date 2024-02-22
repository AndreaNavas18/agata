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
        Nuevo tickect creado, consecutivo
        <span style="background-color: #c9fdc4">{{ isset($ticket->id) ? $ticket->id : 'N/A' }}</span> 🎉
    </p>
    <p>
       Se ha creado un nuevo tickect a continuación los detalles:
    </p>
    <table role="presentation" style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0;">
        <tr>
            <td style="color: #153643; width: 60px; height: 70px;"></td>
            <td style="color: #153643; height: 70px;">
                <br />
                <table align="center" width="500" border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #ccc;">
                    <tr style="border: 1px solid #ccc;">
                        <th style="border: 1px solid #ccc;">Cliente:</th>
                        <td style="border: 1px solid #ccc;">{{ isset($ticket->customer->name) ? $ticket->customer->name : 'N/A' }}</td>
                    </tr>
                    <tr style="border: 1px solid #ccc;">
                        <th style="border: 1px solid #ccc;">Tipo instalación:</th>
                        <td style="border: 1px solid #ccc;">{{ isset($ticket->service->installation_type) ? $ticket->service->installation_type : 'N/A' }}</td>
                    </tr>
                    <tr style="border: 1px solid #ccc;">
                        <th style="border: 1px solid #ccc;">Tipo servicio:</th>
                        <td style="border: 1px solid #ccc;">{{ isset($ticket->service->service->name) ? $ticket->service->service->name : 'N/A' }}</td>
                    </tr>
                    <tr style="border: 1px solid #ccc;">
                        <th style="border: 1px solid #ccc;">Descripción servicio:</th>
                        <td style="border: 1px solid #ccc;">
                            {{ isset($ticket->service->description) ? $ticket->service->description : 'N/A' }}
                        </td>
                    </tr>
                    <tr style="border: 1px solid #ccc;">
                        <th style="border: 1px solid #ccc;">Asunto:</th>
                        <td style="border: 1px solid #ccc;">{{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}</td>
                    </tr>
                    <tr style="border: 1px solid #ccc;">
                        <th style="border: 1px solid #ccc;">Agente:</th>
                        <td style="border: 1px solid #ccc;">{{ isset($ticket->employee->short_name) ? $ticket->employee->short_name : 'N/A' }}</td>
                    </tr>
                </table>
            </td>
            <td style="color: #153643; width: 60px; height: 70px;"></td>
        </tr>
    </table>
@endsection
