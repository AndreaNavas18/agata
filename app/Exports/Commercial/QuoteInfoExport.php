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
        $this->quote = $quote->load('typeDocument');
    }

    public function collection()
    {
        return collect([$this->quote]);
        
    }

    public function map($row): array
    {
        return [
            $row->consecutive,
            $row->issue,
            $row->name,
            $row->typeDocument->name,
            " ".$row->identification,
            $row->email,
            $row->phone
        ];
    }
  

    public function headings(): array
   {
        return [
            'Consecutivo',
            'Asunto',
            'Nombre',
            'Tipo de identificación',
            'Identificación',
            'Correo',
            'Teléfono'
        ];
   }

   public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 25,
            'C' => 20,
            'D' => 13,
            'E' => 50,
            'F' => 15,
            'G' => 15,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' =>  NumberFormat::FORMAT_TEXT,
            'C' =>  NumberFormat::FORMAT_TEXT,
            'D' =>  NumberFormat::FORMAT_TEXT,
            'E' =>  NumberFormat::FORMAT_TEXT,
            'F' =>  NumberFormat::FORMAT_TEXT,
            'G' =>  NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

         // Convertir el contenido de todas las celdas a mayúsculas
         for ($row = 1; $row <= $lastRow; ++$row) {
            for ($col = 'A'; $col !== $lastColumn; ++$col) {
                $cellValue = $sheet->getCell($col . $row)->getValue();
                if (!is_null($cellValue)) { // Verificar si la celda no está vacía
                    $sheet->getCell($col . $row)->setValue(strtoupper($cellValue));
                }
            }
        }

        // Estilo para la primera fila (A1:G1)
         $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
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
        return 'Información cotización';
    }
}
