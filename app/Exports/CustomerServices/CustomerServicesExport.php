<?php

namespace App\Exports\CustomerServices;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerServicesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
{
    use Exportable;

    private $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function collection()
    {

    	return $this->services;
    }

    public function map($services): array
    {
        return [
            $services->customer->typeDocument->name,
            $services->customer->identification,
            $services->customer->name,
            $services->service->name,
            $services->installation_type,
            $services->provider  ? $services->provider->name : '---',
            $services->description,
            $services->date_service,
            $services->city->department->name,
            $services->city->name,
            $services->latitude_coordinates,
            $services->longitude_coordinates,
            $services->state,
        ];

    }

    public function headings(): array
    {
        return [
            'Tipo documento cliente',
            'Identificación cliente',
            'Nombre cliente',
            'Tipo servicio',
            'Tipo instalación',
            'Proveedor',
            'Descripción servicio',
            'Fecha servicio',
            'Departamento',
            'Ciudad',
            'Latitud',
            'Longitud',
            'Estado',
        ];
    }

    public function title(): string
    {
        return 'Clientes servicios';
    }
}
