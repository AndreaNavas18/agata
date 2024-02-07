<?php

namespace App\Exports\Customers;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerContacsSheet implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
{
    use Exportable;

    private $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    public function collection()
    {

    	return $this->customer;
    }

    public function map($customer): array
    {
        foreach ($customer->customerContacs as $contac) {
            return [
                $contac->customer->identification,
                $contac->customer->name,
                $contac->typeContact->name,
                $contac->name,
                $contac->home_phone,
                $contac->cell_phone,
                $contac->email,
                $contac->city->name,
            ];
        }


    }

    public function headings(): array
    {
        return [
            'Identificación cliente',
            'Nombre cliente',
            'Tipo contacto',
            'Nombre',
            'Celular',
            'Fijo',
            'Email',
            'Ciudad',
        ];
    }

    public function title(): string
    {
        return 'Contactos';
    }
}
