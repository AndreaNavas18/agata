{{-- @extends('layouts.email')
@section('content') --}}



<p>
    Se ha creado un nuevo tickect a continuación los detalles:
</p>

<div class="contenedor"
    style="background-image: url('https://i.ibb.co/6mkLfKy/img-sfondo.png');
    background-repeat: no-repeat;
    margin: 0 auto; /* Centrar el div contenedor en la página */
    width: 640px;
    height: 1000px;
    margin-top: 15%;
    text-align: center;"> <!-- Añadido text-align: center para centrar el contenido dentro del contenedor -->

<div class="contenedor"
style="background-image: url('https://i.ibb.co/6mkLfKy/img-sfondo.png');
background-repeat: no-repeat;
margin: 0 auto;
width: 640px;
height: 1000px;
text-align: center;

text-align: center;"> <!-- Añadido text-align: center para centrar el contenido dentro del contenedor -->

<div class="information"
   style="width: 500px; /* Ancho del div de información */
   margin: 0 auto; /* Centrar el div de información dentro del contenedor */
margin-top: 15%;
padding-top: 120px;
   text-align: left;"> <!-- Ajustar el alineamiento del texto dentro del div de información -->

   <table role="presentation" style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0;">
       <tr>
           <td style="color: #153643; width: 60px; height: 70px;"></td>
           <td style="color: #153643; height: 70px;">
               <br />
               <table align="center" width="500" border="0" cellspacing="0" cellpadding="0"
                   style="border: 1px solid #ccc;">
                   <tr style="border: 1px solid #ccc;">
                       <th style="border: 1px solid #ccc;">Cliente:</th>
                       <td style="border: 1px solid #ccc;">
                           {{ isset($ticket->customer->name) ? $ticket->customer->name : 'N/A' }}</td>
                   </tr>
                   <tr style="border: 1px solid #ccc;">
                       <th style="border: 1px solid #ccc;">Tipo instalación:</th>
                       <td style="border: 1px solid #ccc;">
                           {{ isset($ticket->service->installation_type) ? $ticket->service->installation_type : 'N/A' }}
                       </td>
                   </tr>
                   <tr style="border: 1px solid #ccc;">
                       <th style="border: 1px solid #ccc;">Tipo servicio:</th>
                       <td style="border: 1px solid #ccc;">
                           {{ isset($ticket->service->service->name) ? $ticket->service->service->name : 'N/A' }}
                       </td>
                   </tr>
                   <tr style="border: 1px solid #ccc;">
                       <th style="border: 1px solid #ccc;">Descripción servicio:</th>
                       <td style="border: 1px solid #ccc;">
                           {{ isset($ticket->service->description) ? $ticket->service->description : 'N/A' }}
                       </td>
                   </tr>
                   <tr style="border: 1px solid #ccc;">
                       <th style="border: 1px solid #ccc;">Asunto:</th>
                       <td style="border: 1px solid #ccc;">
                           {{ isset($ticket->ticket_issue) ? $ticket->ticket_issue : 'N/A' }}</td>
                   </tr>
                   <tr style="border: 1px solid #ccc;">
                       <th style="border: 1px solid #ccc;">Agente:</th>
                       <td style="border: 1px solid #ccc;">
                           {{ isset($ticket->employee->short_name) ? $ticket->employee->short_name : 'N/A' }}</td>
                   </tr>
               </table>
           </td>
           <td style="color: #153643; width: 60px; height: 70px;"></td>
       </tr>
   </table>
</div>
</div>

{{-- @endsection --}}
