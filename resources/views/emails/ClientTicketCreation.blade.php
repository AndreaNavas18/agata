@extends('emails.layouts.email_stratecsa')

@section('message')
    <div
        style="color:#444a5b;direction:ltr;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:justify;mso-line-height-alt:24px;">


        <p style="margin: 0;">
            Estimado cliente, su ticket {{ $ticket->consecutive }} ha sido creado para responder a su solicitud
            {{ $ticket->ticket_issue }} del servicio {{ $ticket->service->description }}. Estamos trabajando para atender su
            requerimiento y comunicarnos pronto.

        </p>
        <p style="margin: 0;">Gracias por hacer uso de nuestra plataforma.</p>
    </div>
@endsection
