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
use PDPException;

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
    {
        try {
            DB::beginTransaction();
            
            // Datos de la cotización
            $quote = new Quotes();
            $quote->name = $request->name;
            $quote->identification = $request->identification;
            $quote->email = $request->email;
            $quote->phone = $request->phone;
            $quote->direction = $request->direction;
            $quote->observation = $request->observation;

            $quote->save();

            // Datos de las tarifas
            if ($request->has('name_service') && is_array($request->name_service)) {
                foreach ($request->name_service as $index => $name_service) {
                    dd($request->name_service, $request->bandwidth, $request->nrc_12, $request->nrc_24, $request->nrc_36, $request->mrc_12, $request->mrc_24, $request->mrc_36);
                    
                    $tariffQuote = new DetailsQuotesTariffs();
                    $tariffQuote->quote_id = $quote->id;
                    $tariffQuote->name_service = $name_service;
                    $tariffQuote->bandwidth = $request->bandwidth[$index];
                    $tariffQuote->nrc_12 = $request->nrc_12[$index];
                    $tariffQuote->nrc_24 = $request->nrc_24[$index];
                    $tariffQuote->nrc_36 = $request->nrc_36[$index];
                    $tariffQuote->mrc_12 = $request->mrc_12[$index];
                    $tariffQuote->mrc_24 = $request->mrc_24[$index];
                    $tariffQuote->mrc_36 = $request->mrc_36[$index];
                   \Log::info("si se lleno un nameservice");

                   $tariffQuote->save();
                }
            }

            $camposRelevantes = ['tramo', 'trayecto'];

            $seccionesPresentes = false;
            foreach ($camposRelevantes as $campo) {
                if ($request->has($campo) && is_array($request->$campo)) {
                    $seccionesPresentes = true;
                    break;
                }
            }

            if ($seccionesPresentes) {
                foreach ($camposRelevantes as $campo) {
                    if ($request->has($campo) && is_array($request->$campo)) {
                        foreach ($request->$campo as $index => $valor) {
                            $sectionQuote = new DetailsQuotesSection();
                            $sectionQuote->quote_id = $quote->id;
                            $sectionQuote->tramo = $request->tramo[$index];
                            $sectionQuote->trayecto = $request->trayecto[$index];
                            $sectionQuote->hilos = $request->hilos[$index];
                            $sectionQuote->extremo_a = $request->extremo_a[$index];
                            $sectionQuote->extremo_b = $request->extremo_b[$index];
                            $sectionQuote->kms = $request->kms[$index];
                            $sectionQuote->recurrente_mes = $request->recurrente_mes[$index];
                            $sectionQuote->recurrente_12 = $request->recurrente_12[$index];
                            $sectionQuote->recurrente_24 = $request->recurrente_24[$index];
                            $sectionQuote->recurrente_36 = $request->recurrente_36[$index];
                            $sectionQuote->tiempo = $request->tiempo[$index];
                            $sectionQuote->valor_km_usd = $request->valor_km_usd[$index];
                            $sectionQuote->valor_total_iru_usd = $request->valor_total_iru_usd[$index];
                            $sectionQuote->valor_km_cop = $request->valor_km_cop[$index];
                            $sectionQuote->valor_total = $request->valor_total[$index];

                            \Log::info("se lleno un tramo o trayecto");
            
                            $sectionQuote->save();
                        }
                    }
                }
            }

            DB::commit();
            Alert::success('Bien hecho!', 'Registro insertado correctamente');
            return redirect()->route('commercial.quotes.index');
        } catch (PDPException $e) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }
    }

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