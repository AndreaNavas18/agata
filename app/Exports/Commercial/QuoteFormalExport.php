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

class QuoteFormalExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithColumnWidths, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $quote;
    protected $bandwidths;
    protected $typeservices;
    private $itemCounter = 1;

    public function __construct($quote, $bandwidths, $typeservices)
    {
        $this->quote = $quote;
        $this->bandwidths = $bandwidths;
        $this->typeservices = $typeservices;
    }

    public function collection()
    {
        // return DetailsQuotesTariffs::where('quote_id', $this->quote->id)
        // ->with(['bandwidth', 'tariff.comercialTypeService'])
        // ->get();
    }

   
    public function map($row): array
    {   
        // $bandwidthName = 'N/A'; 
        // $typeServiceName = 'N/A';

        // // dd($row->bandwidth, $row->name_service);

        // foreach ($this->bandwidths as $bandRow) {
        //     if ($bandRow->id == $row->bandwidth) {
        //         $bandwidthName = $bandRow->name;
        //         break; 
        //     }
        // }

        
        // foreach ($this->typeservices as $typeRow) {
        //     if ($typeRow->id == $row->tariff->name_service) {
        //         $typeServiceName = $typeRow->name;
        //         break; 
        //         }
        //         }
        // // dd($bandwidthName, $typeServiceName);
                
        // return [
        //     $this->itemCounter++,
        //     $typeServiceName,
        //     $bandwidthName,
        //     $row->mrc_12,
        //     $row->mrc_24,
        //     $row->mrc_36
        // ];
        
    }

    public function headings(): array
    {
        // return [
        //     'ITEM',
        //     'SERVICIO',
        //     'CAPACIDAD',
        //     'RECURRENTE 12 MESES',
        //     'RECURRENTE 24 MESES',
        //     'RECURRENTE 36 MESES',
        // ];
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

        return [];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => '"$"#,##0',
            'E' => '"$"#,##0',
            'F' => '"$"#,##0',
            ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 30,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
        ];
    }

                    
    public function title(): string
    {
        return 'Cotización Formal';
    }
    
}
