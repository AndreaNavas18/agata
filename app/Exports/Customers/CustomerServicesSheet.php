<?php

namespace App\Exports\Customers;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerServicesSheet implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
{
    use Exportable;

    private $customers;

    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    public function collection()
    {

    	return $this->customers;
    }

    public function map($customers): array
    {
        foreach ($customers->customerServices as $service) {
            return [
                $service->customer->identification,
                $service->customer->name,
                $service->service->name,
                $service->description,
                $service->city->department->name,
                $service->city->name,
                $service->date_service,
                $service->latitude_coordinates,
                $service->longitude_coordinates,
                $service->installation_type,
                $service->provider ? $service->provider->name : '---',
                $service->state,
            ];
        }


    }

    public function headings(): array
    {
        return [
            'Identificación cliente',
            'Nombre cliente',
            'Tipo servicio',
            'Descripción servicio',
            'Departamento',
            'Ciudad',
            'Fecha',
            'Latitud',
            'Longitud',
            'Tipo instalación',
            'Proveedor',
            'Estado',
        ];
    }

    public function title(): string
    {
        return 'Servicios';
    }
}
