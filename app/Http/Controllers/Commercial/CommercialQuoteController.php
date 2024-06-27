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

    public function obtenerDetallesAnchoDeBanda($id)
    {
        $bandwidth = CommercialBandwidth::with('tariffs')->find($id);
        if (!$bandwidth) {
            return response()->json(['error' => 'Ancho de banda no encontrado'], 404);
        }

        \Log::info($bandwidth);
    
        return response()->json($bandwidth);
    }

    public function obtenerDetallesTarifa(Request $request)
    {
        \Log::info('Bandwidth ID received: ' . $request->input('bandwidth_id'));
        try {
            $bandwidthId = $request->input('bandwidth_id');
            $serviceId = $request->input('service_id');

            if (!$bandwidthId || !$serviceId) {
                return response()->json(['error' => 'Bandwidth ID and service ID are required'], 400);
            }

            $tarifa = CommercialTariff::where('bandwidth_id', $bandwidthId)
                ->where('commercial_type_service_id', $serviceId)
                ->first();

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