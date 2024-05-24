@extends('emails.layouts.email_stratecsa')

@section('message')
    <div style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">
        <p style="text-align: justify;">
            Se le ha asignado un PQR
        </p>
        <p>A continuación los detalles:</p>
    </div>
@endsection

@section('content')
        <div style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:left;mso-line-height-alt:24px;">
            <p style="margin: 0; margin-bottom: 16px;">
                <span><b>Tema:</b></span>
                {{ isset($pqr->tema) ?  ucfirst(strtolower($pqr->tema->name)) : 'N/A' }}
            </p>
            <p style="margin: 0; margin-bottom: 16px;">
                <span><b>Asunto:</b> {{ isset($pqr->issue) ? $pqr->issue : 'N/A' }}</span>
            </p>

            <p style="margin: 0; margin-bottom: 16px;">
                <span><b>Descripción:</b></span>
                {{ isset($pqr->description) ? $pqr->description : 'N/A' }}
            </p>

        </div>

        <hr style="border-top: 1px solid #ccc; margin-bottom: 20px;">
@endsection
