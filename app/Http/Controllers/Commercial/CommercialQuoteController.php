<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Commercial\DetailsQuotesSection;
use App\Models\Commercial\DetailsQuotesTariffs;
use App\Models\Commercial\Quotes;
use App\Models\Commercial\CommercialTariff;
use App\Models\Commercial\CommercialTypeService;
use App\Models\Commercial\CommercialBandwidth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Commercial\QuoteExport;
use App\Exports\Commercial\SectionsExport;
use App\Exports\Commercial\QuoteCompleteExport;
use App\Exports\Commercial\QuoteFormalComplete;
use App\Models\General\TypeDocument;
use App\Models\General\Department;
use PDPException;

class CommercialQuoteController extends Controller
{
    public function index(Request $request)
    {
        session::flash('tab','quotes');
        $quotes = Quotes::orderBy('id', 'DESC')->paginate();
        $quotesTariffs = DetailsQuotesTariffs::all();
        $quotesSections = DetailsQuotesSection::all();

        return view('modules.commercial.quotes.index', compact('quotes', 'quotesTariffs', 'quotesSections'));
        
    }

    public function create()
    {
        $tarifas = CommercialTariff::all();
        $servicios = CommercialTypeService::all();
        $typeDocuments = TypeDocument::all();
        $departamentos = Department::all();

        return view('modules.commercial.quotes.create', compact('tarifas', 'servicios', 'typeDocuments', 'departamentos'));
    }

    public function store(Request $request)
    {
        // Validación de los datos de la cotización
        $request->validate([
            'issue' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type_document_id' => 'nullable|integer',
            'identification' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string|max:255',
            // Puedes agregar más validaciones según tus necesidades
        ]);
    
        // Crear la cotización
        $quote = Quotes::create([
            'issue' => $request->issue,
            'name' => $request->name,
            'identification' => $request->identification,
            'email' => $request->email,
            'phone' => $request->phone,
            'observation' => $request->observation,
        ]);
    
        // Guardar servicios en la tabla intermedia
        if ($request->has('service_id')) {
            foreach ($request->service_id as $index => $service_id) {
                if ($service_id) {
                    DetailsQuotesTariffs::create([
                        'quote_id' => $quote->id,
                        'tariff_id' => $service_id,  // Asumiendo que el service_id es el tariff_id
                        'address' => $request->address[$index],
                        'observation' => $request->observation[$index] ?? null,
                        'nrc_12' => $request->nrc_12[$index] ?? null,
                        'nrc_24' => $request->nrc_24[$index] ?? null,
                        'nrc_36' => $request->nrc_36[$index] ?? null,
                        'mrc_12' => $request->mrc_12[$index] ?? null,
                        'mrc_24' => $request->mrc_24[$index] ?? null,
                        'mrc_36' => $request->mrc_36[$index] ?? null,
                    ]);
                }
            }
        }
    
        // Guardar tramos en la tabla intermedia
        if ($request->has('tramo')) {
            foreach ($request->tramo as $index => $tramo) {
                if ($tramo) {
                    DetailsQuotesSection::create([
                        'quote_id' => $quote->id,
                        'service_id' => $request->service_id[$index],  // Asumiendo que el service_id está en la misma posición
                        'tramo' => $request->tramo[$index],
                        'trayecto' => $request->trayecto[$index] ?? null,
                        'hilos' => $request->hilos[$index] ?? null,
                        'extremo_a' => $request->extremo_a[$index] ?? null,
                        'extremo_b' => $request->extremo_b[$index] ?? null,
                        'kms' => $request->kms[$index] ?? null,
                        'recurrente_mes' => $request->recurrente_mes[$index] ?? null,
                        'recurrente_12' => $request->recurrente_12[$index] ?? null,
                        'recurrente_24' => $request->recurrente_24[$index] ?? null,
                        'recurrente_36' => $request->recurrente_36[$index] ?? null,
                        'tiempo' => $request->tiempo[$index] ?? null,
                        'valor_km_usd' => $request->valor_km_usd[$index] ?? null,
                        'valor_total_iru_usd' => $request->valor_total_iru_usd[$index] ?? null,
                        'valor_km_cop' => $request->valor_km_cop[$index] ?? null,
                        'valor_total' => $request->valor_total[$index] ?? null,
                        'observation' => $request->observation[$index] ?? null,
                    ]);
                }
            }
        }
    
        return redirect()->route('quotes.index')->with('success', 'Cotización creada exitosamente.');
    }
    


    public function obtenerAnchosDeBanda(Request $request)
    {
        $servicio_id = $request->input('servicio_id');
        $department_id = $request->input('department_id');
        $city_id = $request->input('city_id');

        $tariffs = CommercialTariff::whereHas('comercialTypeService', function ($query) use ($servicio_id) {
            $query->where('id', $servicio_id);
        })->whereHas('bandwidth', function ($query) use ($department_id, $city_id) {
            $query->where('department_id', $department_id)
                  ->where('city_id', $city_id);
        })->with(['bandwidth', 'comercialTypeService'])->get();

        \Log::info($tariffs);
    
        return response()->json($tariffs);
    }

    public function obtenerDetallesAnchoDeBanda(Request $request)
    {
        // $bandwidth = CommercialBandwidth::with('tariffs')->find($id);

        // if (!$bandwidth) {
        //     return response()->json(['error' => 'Ancho de banda no encontrado'], 404);
        // }

        // \Log::info('Heyyy'.$bandwidth);
    
        // return response()->json($bandwidth);

        \Log::info('Request Data: ', $request->all());
        $serviceId = $request->query('servicio_id');

        $bandwidths = CommercialBandwidth::whereHas('tariffs', function ($query) use ($serviceId) {
            $query->where('commercial_type_service_id', $serviceId);
        })->get();
    
        \Log::info('Bandwidths found: ' . $bandwidths);
    
        return response()->json($bandwidths);
    }

    public function obtenerDetallesTarifa(Request $request)
    {
        \Log::info('Bandwidth ID received: ' . $request->input('bandwidth_id'));
        \Log::info('Request Data: ', $request->all());
        try {
            $bandwidthId = $request->input('bandwidth_id');
            $serviceId = $request->input('service_id');

            if (!$bandwidthId || !$serviceId) {
                return response()->json(['error' => 'Bandwidth ID and service ID are required'], 400);
            }

            $tarifa = CommercialTariff::where('bandwidth_id', $bandwidthId)
                ->where('commercial_type_service_id', $serviceId)
                ->first();
                
            
            \Log::info('Tarifa encontrada: ' . json_encode($tarifa));
            \Log::info('tarifa: ' . $tarifa);

            if (!$tarifa) {
                return response()->json(['error' => 'No tariff found for the given bandwidth ID and service ID'], 404);
            }

            return response()->json([
                'recurring_value_12' => $tarifa->recurring_value_12,
                'recurring_value_24' => $tarifa->recurring_value_24,
                'recurring_value_36' => $tarifa->recurring_value_36,
                'value_mbps_12' => $tarifa->value_mbps_12,
                'value_mbps_24' => $tarifa->value_mbps_24,
                'value_mbps_36' => $tarifa->value_mbps_36,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the tariff details'], 500);
        }
    }



    public function manage($id, Request $request) {
       
    }

    public function destroy($id) {


    }

    public function search(Request $request)
    {
      
    }

    public function edit ($id) {
       
    }

    public function update(Request $request, $id)
    {
       
    }


    public function export($id)
    {
        $quote = Quotes::findOrFail($id);
        $bandwidths = CommercialBandwidth::all();
        $typeservices = CommercialTypeService::all();
       
        $export = new QuoteCompleteExport($quote, $bandwidths, $typeservices);

        $consecutive = $quote->consecutive;
    
        return Excel::download($export, 'cotizacion_'.$consecutive.'.xlsx');

    }


}