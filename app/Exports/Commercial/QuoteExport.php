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

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

use App\Models\Commercial\DetailsQuotesTariffs;
use App\Models\Commercial\CommercialTariff;

class QuoteExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithColumnWidths, ShouldAutoSize, WithStyles
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
        // Estilo para la primera fila (A1:G1)
        $sheet->getStyle('A1:G1')->applyFromArray([
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
        return 'Cotizacion';
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
            'B' => 13,
            'C' => 13,
            'D' => 13,
            'E' => 13,
            'F' => 13,
            'G' => 13,
        ];
    }

    
}
