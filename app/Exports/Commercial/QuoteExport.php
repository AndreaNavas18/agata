<?php

namespace App\Exports\Commercial;

use App\Models\Commercial\Quotes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

use App\Models\Commercial\DetailsQuotesTariffs;
use App\Models\Commercial\CommercialTariff;

class QuoteExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithColumnWidths, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $quote;
    protected $bandwidths;

    public function __construct($quote, $bandwidths)
    {
        $this->quote = $quote;
        $this->bandwidths = $bandwidths;
    }

    public function collection()
    {
        return DetailsQuotesTariffs::where('quote_id', $this->quote->id)
        ->with(['bandwidth'])
        ->get();
    }

   
    public function map($row): array
    {
        // $bandwidthName = $row->bandwidth->name ?? 'N/A';
        // dd($bandwidthName);

        $bandwidthName = 'N/A'; 

        foreach ($this->bandwidths as $bandRow) {
            if ($bandRow->id == $row->bandwidth) {
                $bandwidthName = $bandRow->name;
                break; 
            }
        }

        return [
            $bandwidthName,
            $row->nrc_12,
            $row->nrc_24,
            $row->nrc_36,
            $row->mrc_12,
            $row->mrc_24,
            $row->mrc_36,
        ];
    }

    public function headings(): array
    {
        return [
            'Velocidad (mbps)',
            'NRC 12 Meses',
            'NRC 24 Meses',
            'NRC 36 Meses',
            'MRC 12 Meses',
            'MRC 24 Meses',
            'MRC 36 Meses',

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
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '297ff0',  // Color azul claro en formato RGB
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
    

    
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => '"$"#,##0',
            'C' => '"$"#,##0',
            'D' => '"$"#,##0',
            'E' => '"$"#,##0',
            'F' => '"$"#,##0',
            'G' => '"$"#,##0',
            ];
    }
            
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 16,
            'C' => 16,
            'D' => 16,
            'E' => 16,
            'F' => 16,
            'G' => 16,
            ];
    }
                    
    public function title(): string
    {
        return 'Cotización';
    }
    
}
