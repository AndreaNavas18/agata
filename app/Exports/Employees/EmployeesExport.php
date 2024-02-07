<?php

namespace App\Exports\Employees;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
{
    use Exportable;

    private $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function collection()
    {

    	return $this->employees;
    }

    public function map($employees): array
    {
        return [
            $employees->typeDocument->name,
            $employees->identification,
            $employees->first_name,
            $employees->second_name,
            $employees->surname,
            $employees->second_surname,
            $employees->full_name,
            $employees->birth_date,
            $employees->email,
            $employees->address,
            $employees->home_phone,
            $employees->cell_phone,
            $employees->arl ? $employees->arl->name : '',
            $employees->pension ? $employees->pension->name : '',
            $employees->cesantias ? $employees->cesantias->name : '',
            $employees->eps ? $employees->eps->name : '',
            $employees->position ? $employees->position->department->name : '',
            $employees->position ? $employees->position->name : '',
            $employees->state->name,
        ];

    }

    public function headings(): array
    {
        return [
            'Tipo documento',
            'Identificación',
            'Primer nombre',
            'Segundo nombre',
            'Primer apellido',
            'Segundo apellido',
            'Nombre completo',
            'Fecha nacimiento',
            'email',
            'Dirección',
            'Telefono fijo',
            'Celular',
            'ARL',
            'Pensión',
            'Cesantias',
            'EPS',
            'Departamento cargo',
            'Cargo',
            'Estado'
        ];
    }

    public function title(): string
    {
        return 'Empleados';
    }
}
