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

class CommercialQuoteController extends Controller
{
    public function index(Request $request)
    {
        $quotes = Quotes::orderBy('id', 'DESC')->paginate();
        $quotesTariffs = DetailsQuotesTariffs::all();
        $quotesSections = DetailsQuotesSection::all();

        return view('modules.commercial.quotes.index', compact('quotes', 'quotesTariffs', 'quotesSections'));
    }

    public function create()
    {
        $tarifas = CommercialTariff::all();
        $servicios = CommercialTypeService::all();

        return view('modules.commercial.quotes.create', compact('tarifas', 'servicios'));
    }


    public function store(Request $request)
    {}

    public function obtenerAnchosDeBanda(Request $request)
    {
        $servicioId = $request->input('servicio_id');

        $bandwidthIds = CommercialTariff::where('commercial_type_service_id', $servicioId)
                                        ->pluck('bandwidth_id');

        $bandwidths = CommercialBandwidth::whereIn('id', $bandwidthIds)->get();

        return response()->json($bandwidths);
    }

    public function obtenerDetallesTarifa(Request $request)
    {
        \Log::info('Bandwidth ID received: ' . $request->input('bandwidth_id'));
        try {
            $bandwidthId = $request->input('bandwidth_id');
            if (!$bandwidthId) {
                return response()->json(['error' => 'Bandwidth ID is required'], 400);
            }
    
            $tarifa = CommercialTariff::where('bandwidth_id', $bandwidthId)->first();
    
            if (!$tarifa) {
                return response()->json(['error' => 'No tariff found for the given bandwidth ID'], 404);
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


}