<?php

namespace App\Exports\Providers;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProviderInfoSheet implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
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
        return [
            $providers->typeDocument->name,
            $providers->identification,
            $providers->name,
            $providers->address,
            $providers->city->department->name,
            $providers->city->name,
            $providers->state->name,
        ];

    }

    public function headings(): array
    {
        return [
            'Tipo documento',
            'Identificación',
            'Nombre',
            'Dirección',
            'Departamento',
            'Ciudad',
            'Estado',
        ];
    }

    public function title(): string
    {
        return 'Información';
    }
}
