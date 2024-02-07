<?php

namespace App\Exports\Tickets;

use App\Models\Helpers;
use App\Models\Tickets\Ticket;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
{
    use Exportable;

    private $tickets;

    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    public function collection()
    {

    	return $this->tickets;
    }

    public function map($tickets): array
    {
        $timeActually= Carbon::now();
        $timeClock=$tickets->state_clock == 'Corriendo' ?Ticket::calculateTimeClock($timeActually, $tickets) :$timeClock=$tickets->time_clock;
        return [
            $tickets->id,
            $tickets->date,
            $tickets->ticket_issue,
            $tickets->department->name,
            $tickets->employee->short_name,
            $tickets->customer->name,
            $tickets->service->installation_type,
            $tickets->service->service->name,
            $tickets->service->description,
            Auth()->user()->role_id!=2 && $tickets->service->provider ?  $tickets->service->provider->name : '---',
            $tickets->service->city->name,
            $tickets->description,
            $tickets->priority->name,
            $tickets->state_clock,
            $tickets->date,
            $tickets->priority_id==1 && $tickets->state_clock=='Corriendo' ? Carbon::now()->format('Y-m-d') :
            ($tickets->priority_id==1 && $tickets->state_clock=='Detenido' ? Carbon::parse($tickets->datetime_clock)->format('Y-m-d') :
            'N/A'),
            $timeClock,
            $tickets->priority_id==1 ? Helpers::calcularDisponibilidadTicket($tickets->id).'%' : 'N/A',
            $tickets->state,
        ];

    }

    public function headings(): array
    {
        $columns = [
            'Consecutivo',
            'Fecha',
            'Asunto',
            'Departamento cargo',
            'Agente',
            'Cliente',
            'Tipo instalacion',
            'Tipo servicio',
            'Servicio descripción',
            'Ciudad',
            'Descripción',
            'Prioridad',
            'Estado reloj',
            'Fecha Inicio',
            'Fecha Fin',
            'Tiempo reloj',
            'Disponibilidad',
            'Estado'
        ];

        if (Auth()->user()->role_id != 2) {
            // Agregar la columna "Proveedor" después de "Servicio descripción" si el usuario no tiene el rol con ID 2
            array_splice($columns, 9, 0, 'Proveedor');
        }

        return $columns;
    }

    public function title(): string
    {
        return 'Tickets';
    }
}
