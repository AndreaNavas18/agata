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
        $bandwidthId = $request->input('bandwidth');

        $tarifa = CommercialTariff::where('bandwidth_id', $bandwidthId)->first();
        return response()->json([
            'recurring_value_12'    => $tarifa->recurring_value_12,
            'recurring_value_24'    => $tarifa->recurring_value_24,
            'recurring_value_36'    => $tarifa->recurring_value_36,
            'value_mbps_12'         => $tarifa->value_mbps_12,
            'value_mbps_24'         => $tarifa->value_mbps_24,
            'value_mbps_36'         => $tarifa->value_mbps_36,
        ]);
    }


}