<?php

namespace App\Exports\Customers;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerInfoSheet implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
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
        return [
            $customers->typeDocument->name,
            $customers->identification,
            $customers->name,
            $customers->address,
            $customers->city->department->name,
            $customers->city->name,
            $customers->state->name,
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
