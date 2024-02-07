<?php

namespace App\Exports\Providers;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProviderServicesSheet implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
{
    use Exportable;

    private $providers;

    public function __construct($providers)
    {
        $this->providers = $providers;
    }

    public function collection()
    {

    	return $this->providers;
    }

    public function map($providers): array
    {
        foreach ($providers->services as $service) {
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
