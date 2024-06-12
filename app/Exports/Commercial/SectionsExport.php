<?php

namespace App\Exports\Commercial;

use App\Models\Commercial\Quotes;
use App\Models\Commercial\DetailsQuotesSection;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SectionsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    protected $quote;

    public function __construct(Quotes $quote)
    {
        $this->quote = $quote;
    }

    public function collection()
    {
        // return DetailsQuotesSection::where('quote_id', $this->quote->id)->get();
        return DetailsQuotesSection::select(
            'tramo',
            'trayecto',
            'hilos',
            'extremo_a',
            'extremo_b',
            'kms',
            'recurrente_mes',
            'recurrente_12',
            'recurrente_24',
            'recurrente_36',
            'tiempo',
            'valor_km_usd',
            'valor_total_iru_usd',
            'valor_km_cop',
            'valor_total'
        )
        ->where('quote_id', $this->quote->id)
        ->get();
    }

    public function map($row): array
    {
        return [
            $row->tramo,
            $row->trayecto,
            $row->hilos,
            $row->extremo_a,
            $row->extremo_b,
            $row->kms,
            $row->recurrente_mes,
            $row->recurrente_12,
            $row->recurrente_24,
            $row->recurrente_36,
            $row->tiempo,
            $row->valor_km_usd,
            $row->valor_total_iru_usd,
            $row->valor_km_cop,
            $row->valor_total,
        ];
    }
  

    public function headings(): array
   {
        return [
            'Tramo',
            'Trayecto',
            'Hilos',
            'Extremo A',
            'Extremo B',
            'Kms',
            'Recurrente Mes',
            'Recurrente 12',
            'Recurrente 24',
            'Recurrente 36',
            'Tiempo',
            'Valor Km USD',
            'Valor Total IRU USD',
            'Valor Km COP',
            'Valor Total',
        ];
   }

    public function styles(Worksheet $sheet)
    {
        // Estilo para la primera fila (A1:G1)
        $sheet->getStyle('A1:O1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '297ff0',  // Color azul claro en formato RGB
                ],
            ],
        ]);

        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],  // Color del borde en formato RGB
                ],
            ],
        ]);

        return [];
    }

    public function title(): string
    {
        return 'Secciones';
    }
}
