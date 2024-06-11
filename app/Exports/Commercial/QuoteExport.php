<?php

namespace App\Exports\Commercial;

use App\Models\Commercial\Quotes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuoteExport implements FromCollection, WithHeadings
{
    protected $quote;

    public function __construct(Quotes $quote)
    {
        $this->quote = $quote;
    }

    public function collection()
    {
         // Obtener los detalles de las tarifas de la cotización
         $tariffs = $this->quote->detailsQuotesTariffs;

         //manejar el caso si es null 

        //  $servicesNames = $tariffs->pluck('name_service')->unique();
        //  $bandwidthsNames = $tariffs->pluck('bandwidth')->unique();

         // Obtener las secciones de la cotización
         $sections = $this->quote->detailsQuotesSections;

         $data = collect([
            [
                'Asunto' => $this->quote->issue,
            ]
        ]);
        if ($tariffs) {
        foreach ($tariffs as $tariff) {
            $data->push([
                'ID Tarifa' => $tariff->id,
            ]);
        }
    }
    if ($sections) {
        foreach ($sections as $section) {
            $data->push([
                'ID Sección' => $section->id,
                'Tramo' => $section->tramo,
                'Trayecto' => $section->trayecto,
            ]);
        }
    }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Asunto',
             // Encabezados de las columnas de tarifas
             'ID Tarifa',

              // Encabezados de las columnas de secciones
            'ID Sección',
            'Tramo',
            'Trayecto',
        ];
    }
}
