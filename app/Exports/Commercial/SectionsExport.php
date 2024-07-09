<?php

namespace App\Exports\Commercial;

use App\Models\Commercial\Quotes;
use App\Models\Commercial\DetailsQuotesSection;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SectionsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    protected $quote;
    protected $filteredColumns;

    public function __construct(Quotes $quote)
    {
        $this->quote = $quote;
        $this->filteredColumns = $this->filterColumns();
    }

    public function collection()
    {
        return DetailsQuotesSection::select($this->filteredColumns)
        ->where('quote_id', $this->quote->id)
        ->get();
        
    }

    private function filterColumns()
    {
        $columns = [
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
            'valor_total',
            'observation'
        ];

        $filteredColumns = [];
        foreach ($columns as $column) {
            if (!empty(DetailsQuotesSection::where('quote_id', $this->quote->id)->value($column))) {
                $filteredColumns[] = $column;
            }
        }

        return $filteredColumns;
    }

    public function map($row): array
    {
        $data = [];
        foreach ($this->filteredColumns as $column) {
            $data[] = $row->$column ?? '';
        }
        return $data;
    }
  

    public function headings(): array
   {
    $headings = [];
    $columnNames = [
            'tramo' => 'Tramo',
            'trayecto' => 'Trayecto',
            'hilos' => 'Hilos',
            'extremo_a' => 'Extremo A',
            'extremo_b' => 'Extremo B',
            'kms' => 'Kms',
            'recurrente_mes' => 'Recurrente Mes',
            'recurrente_12' => 'Recurrente 12',
            'recurrente_24' => 'Recurrente 24',
            'recurrente_36' => 'Recurrente 36',
            'tiempo' => 'Tiempo',
            'valor_km_usd' => 'Valor Km USD',
            'valor_total_iru_usd' => 'Valor Total IRU USD',
            'valor_km_cop' => 'Valor Km COP',
            'valor_total' => 'Valor Total',
            'observation' => 'Condiciones'
        ];

        foreach ($this->filteredColumns as $column) {
            $headings[] = $columnNames[$column];
        }

        return $headings;
   }


    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Estilo para la primera fila (A1:G1)
         $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],  // Color blanco
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '195DA1',  // Color azul claro en formato RGB
                ],

            ],
        ]);

        for ($row = 1; $row <= $lastRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(20);
        }

        for ($row = 2; $row <= $lastRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(30);
        }

        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],  // Color del borde en formato RGB
                ],
            ],
        ]);

        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getAlignment()->setVertical('center');


        return [];
    }

    public function title(): string
    {
        return 'Secciones';
    }
}
