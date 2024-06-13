<?php

namespace App\Exports\Commercial;

use App\Models\Commercial\Quotes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class QuoteInfoExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle, WithColumnWidths
{
    use Exportable;

    protected $quote;

    public function __construct(Quotes $quote)
    {
        $this->quote = $quote;
    }

    public function collection()
    {
        return collect([$this->quote]);
        
    }

    public function map($row): array
    {
        return [
            $row->issue,
            $row->name,
            $row->identification,
            $row->email,
            $row->phone,
            $row->direction,
            $row->observation
        ];
    }
  

    public function headings(): array
   {
        return [
            'Asunto',
            'Nombre',
            'Identificación',
            'Correo',
            'Teléfono',
            'Dirección',
            'Observación'
        ];
   }

   public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 20,
            'D' => 23,
            'E' => 15,
            'F' => 15,
            'G' => 50,  // Ancho mayor para la columna de Observación
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Estilo para la primera fila (A1:G1)
         $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FF8B01',  // Color azul claro en formato RGB
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

        return [];
    }

    public function title(): string
    {
        return 'Cotización información';
    }
}
