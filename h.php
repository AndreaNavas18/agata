<?php 


// use App\Http\Controllers\ExcelController;

// Route::post('/llenar-excel', [ExcelController::class, 'llenarExcel']);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends Controller
{
    public function llenarExcel(Request $request)
    {
        // Ruta a la plantilla existente
        $templatePath = storage_path('app/public/ORDEN DE SERVICIO  1.1.xlsx');
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Datos del formulario
        $datosFormulario = $request->all();

        // Llenar los datos en las celdas correspondientes
        $sheet->setCellValue('D6', $datosFormulario['fecha']);
        $sheet->setCellValue('K6', $datosFormulario['contrato']);
        $sheet->setCellValue('D10', $datosFormulario['razon_social']);
        $sheet->setCellValue('D11', $datosFormulario['tipo_documento']);
        $sheet->setCellValue('I11', $datosFormulario['numero_documento']);
        $sheet->setCellValue('D12', $datosFormulario['representante_legal']);
        $sheet->setCellValue('D13', $datosFormulario['direccion']);
        $sheet->setCellValue('D17', $datosFormulario['nombre_contacto_comercial']);
        $sheet->setCellValue('K17', $datosFormulario['email_contacto_comercial']);
        $sheet->setCellValue('D18', $datosFormulario['telefono_fijo_contacto_comercial']);
        $sheet->setCellValue('K18', $datosFormulario['celular_contacto_comercial']);
        // Añade más campos según sea necesario

        // Guardar el archivo modificado
        $outputPath = storage_path('app/public/ORDEN_DE_SERVICIO_LLENADA.xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save($outputPath);

        return response()->download($outputPath);
    }
}
