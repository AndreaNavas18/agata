<?php

namespace App\Exports\Commercial;

use App\Models\Commercial\Quotes;
use App\Models\Commercial\DetailsQuotesTariffs;
use App\Models\Commercial\CommercialBandwidth;

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

class QuoteFormalInfo implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle, WithColumnWidths
{
    use Exportable;

    protected $quote;
    protected $bandwidths;
    protected $typeservices;
    private $itemCounter = 1;


    public function __construct(Quotes $quote, $bandwidths, $typeservices)
    {
        $this->quote = $quote;
        $this->bandwidths = $bandwidths;
        $this->typeservices = $typeservices;
    }

    public function collection()
    {
        return DetailsQuotesTariffs::where('quote_id', $this->quote->id)
            ->with(['tariff.bandwidth', 'tariff.comercialTypeService'])
            ->get()
            ->map(function ($item) {
                $bandwidth = CommercialBandwidth::with(['department', 'city'])->find($item->tariff->bandwidth_id);
                $item->bandwidth_department_name = optional($bandwidth->department)->name ?? 'N/A';
                $item->bandwidth_city_name = optional($bandwidth->city)->name ?? 'N/A';
                return $item;
            });
    }

    public function map($row): array
    {
        $bandwidthName = 'N/A'; 
        $typeServiceName = 'N/A';

        foreach ($this->bandwidths as $bandRow) {
            if ($bandRow->id == $row->tariff->bandwidth->id) {
                $bandwidthName = $bandRow->name;
                break; 
            }
        }
        
        foreach ($this->typeservices as $typeRow) {
            if ($typeRow->id == $row->tariff->comercialTypeService->id) {
                $typeServiceName = $typeRow->name;
                break; 
                }
                }
                
        return [
            $this->itemCounter++,
            $typeServiceName,
            $bandwidthName,
            $row->bandwidth_department_name,
            $row->bandwidth_city_name,
            $row->address,
        ];
        
    }
  

    public function headings(): array
   {
        return [
            'ITEM',
            'SERVICIO',
            'CAPACIDAD',
            'DEPARTAMENTO',
            'CIUDAD',
            'DIRECCIÓN | COORDENADAS',
        ];
   }

   public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 23,
            'D' => 20,
            'E' => 25,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Obtener el rango completo de celdas que contienen datos
        $cellRange = 'A1:' . $lastColumn . $lastRow;
        $cells = $sheet->rangeToArray($cellRange);
    
        // Convertir todos los valores a mayúsculas
        foreach ($cells as $rowIndex => $row) {
            foreach ($row as $colIndex => $value) {
                $cells[$rowIndex][$colIndex] = strtoupper($value);
            }
        }
    
        // Escribir los valores convertidos de nuevo en la hoja
        $sheet->fromArray($cells, null, 'A1');

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
        return 'Items';
    }
}
