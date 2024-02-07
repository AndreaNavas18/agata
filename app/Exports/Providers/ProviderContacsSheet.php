<?php

namespace App\Exports\Providers;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProviderContacsSheet implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle
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
        foreach ($providers->customerContacs as $contac) {
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
