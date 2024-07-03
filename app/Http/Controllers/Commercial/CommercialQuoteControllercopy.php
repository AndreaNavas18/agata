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

        return view('modules.commercial.quotes.create', compact('tarifas', 'servicios', 'typeDocuments'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Datos de la cotización
            $quote = new Quotes();
            $quote->issue = $request->issue;
            $quote->name = $request->name;
            $quote->type_document_id = $request->type_document_id;
            $quote->identification = $request->identification;
            $quote->email = $request->email;
            $quote->phone = $request->phone;
            $quote->save();

            // Guardar detalles de tarifas por cada servicio y ancho de banda
            if ($request->has('name_service') && is_array($request->name_service)) {
                foreach ($request->name_service as $index => $nameService) {
                    $tariffQuote = new DetailsQuotesTariffs();
                    $tariffQuote->quote_id = $quote->id;
                    $tariffQuote->name_service = $nameService;
                    $tariffQuote->bandwidth = $request->bandwidth[$index];
                    $tariffQuote->address = $request->address[$index] ?? null;
                    $tariffQuote->observation = $request->observation[$index] ?? null;
                    $tariffQuote->nrc_12 = $request->nrc_12[$index];
                    $tariffQuote->nrc_24 = $request->nrc_24[$index];
                    $tariffQuote->nrc_36 = $request->nrc_36[$index];
                    $tariffQuote->mrc_12 = $request->mrc_12[$index];
                    $tariffQuote->mrc_24 = $request->mrc_24[$index];
                    $tariffQuote->mrc_36 = $request->mrc_36[$index];
                    $tariffQuote->save();
                }
            }

            // Guardar detalles de secciones si están presentes
            $camposRelevantes = ['tramo', 'trayecto'];
            $seccionesPresentes = false;

            foreach ($camposRelevantes as $campo) {
                if ($request->has($campo) && is_array($request->$campo)) {
                    $seccionesPresentes = true;
                    break;
                }
            }

            if ($seccionesPresentes) {
                $cantidadSecciones = count($request->tramo);

                for ($index = 0; $index < $cantidadSecciones; $index++) {
                    $sectionQuote = new DetailsQuotesSection();
                    $sectionQuote->quote_id = $quote->id;
                    $sectionQuote->name_service = $request->name_service[$index];
                    $sectionQuote->tramo = $request->tramo[$index] ?? null;
                    $sectionQuote->trayecto = $request->trayecto[$index] ?? null;
                    $sectionQuote->hilos = $request->hilos[$index] ?? null;
                    $sectionQuote->extremo_a = $request->extremo_a[$index] ?? null;
                    $sectionQuote->extremo_b = $request->extremo_b[$index] ?? null;
                    $sectionQuote->kms = $request->kms[$index] ?? null;
                    $sectionQuote->recurrente_mes = $request->recurrente_mes[$index] ?? null;
                    $sectionQuote->recurrente_12 = $request->recurrente_12[$index] ?? null;
                    $sectionQuote->recurrente_24 = $request->recurrente_24[$index] ?? null;
                    $sectionQuote->recurrente_36 = $request->recurrente_36[$index] ?? null;
                    $sectionQuote->tiempo = $request->tiempo[$index] ?? null;
                    $sectionQuote->valor_km_usd = $request->valor_km_usd[$index] ?? null;
                    $sectionQuote->valor_total_iru_usd = $request->valor_total_iru_usd[$index] ?? null;
                    $sectionQuote->valor_km_cop = $request->valor_km_cop[$index] ?? null;
                    $sectionQuote->valor_total = $request->valor_total[$index] ?? null;
                    $sectionQuote->observation = $request->observation[$index] ?? null;
                    $sectionQuote->save();
                }
            }

            DB::commit();
            return redirect()->route('commercial.quotes.index')
                ->with('success', 'Registro insertado correctamente');
        } catch (PDPException $e) {
            DB::rollBack();
            Log::error('Error al insertar registro: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al insertar registro.');
        }
    }

    public function obtenerAnchosDeBanda(Request $request)
    {
        $servicioId = $request->input('servicio_id');

        // $bandwidthIds = CommercialTariff::where('commercial_type_service_id', $servicioId)
        //                                 ->pluck('bandwidth_id');

        // $bandwidths = CommercialBandwidth::whereIn('id', $bandwidthIds)->get();

        $bandwidths = CommercialBandwidth::whereHas('tariffs', function ($query) use ($servicioId) {
            $query->where('commercial_type_service_id', $servicioId);
        })->get();

        if ($bandwidths->isEmpty()) {
            $bandwidths = DetailsQuotesSection::where('name_service', $servicioId)->get();
            return response()->json(['type' => 'tramos', 'data' => $tramos]);
        }

        return response()->json($bandwidths);
    }

    public function obtenerDetallesTarifa(Request $request)
    {
        \Log::info('Bandwidth ID received: ' . $request->input('bandwidth_id'));
        try {
            $bandwidthId = $request->input('bandwidth_id');
            $nameService = $request->input('name_service');

            if (!$bandwidthId || !$nameService) {
                return response()->json(['error' => 'Bandwidth ID and name service are required'], 400);
            }
    
            $tarifa = CommercialTariff::where('bandwidth_id', $bandwidthId)
                                    ->where('name_service', $nameService)
                                    ->first();

            \Log::info('tarifa: ' . $tarifa);
    
            if (!$tarifa) {
                return response()->json(['error' => 'No tariff found for the given bandwidth ID and name service'], 404);
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

    public function obtenerTiposDocumentos()
    {
        $typeDocuments = TypeDocument::all();
        return response()->json($typeDocuments);
    }


    public function manage($id, Request $request) {
        $quote = Quotes::findOrFail($id);
        $tariff = DetailsQuotesTariffs::where('quote_id', $id)->get();
        $section = DetailsQuotesSection::where('quote_id', $id)->get();
        $services = CommercialTypeService::all();
        $bandwidths = CommercialBandwidth::all();

        return view('modules.commercial.quotes.manage', compact(
          'quote', 'tariff', 'section', 'services', 'bandwidths'
        ));
    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            $quote = Quotes::findOrFail($id);
            if (!$quote->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DetailsQuotesTariffs::where('quote_id', $id)->delete();
            DetailsQuotesSection::where('quote_id', $id)->delete();

            DB::commit();
            Alert::success('¡Éxito!', 'Registro eliminado correctamente');
            return redirect()->back();
        } catch (QueryException $th) {
            if ($th->getCode() === '23000') {
                Alert::error('Error!', 'No se puede eliminar el registro porque está asociado con otro registro.');
                return redirect()->back();
            } else {
                Alert::error('Error!', $th->getMessage());
                return redirect()->back();
            }
        }

    }

    public function search(Request $request)
    {
        $issue = strtolower($request->input('issue'));
        $name = $request->input('name');
        $identification = $request->input('identification');

        $query = Quotes::query();

        // Aplicar la búsqueda por asunto si se proporcionó
        if (!empty($issue)) {
            $query->where('issue', 'LIKE', "%$issue%");
        }
        
        // Aplicar la búsqueda por nombre si se proporcionó
        if (!empty($name)) {
            $query->where('name', 'LIKE', "%$name%");
        }

        // Aplicar la búsqueda por identificación si se proporcionó
        if (!empty($identification)) {
            $query->where('identification', 'LIKE', "%$identification%");
        }

        $quotes = $query->paginate();
        $data = $request->all();

        return view('modules.commercial.quotes.index', compact('quotes', 'data'));
    }

    public function edit ($id) {
        $quote = Quotes::with(['tariffs.tariff', 'tariffs.bandwidth', 'sections'])->findOrFail($id);
        $tarifas = CommercialTariff::all();
        $servicios = CommercialTypeService::all();
        $typeDocuments = TypeDocument::all();


        if ($quote->tariffs->isNotEmpty()) {
            $servicioId = $quote->tariffs->first()['name_service'];
        } else {
            $servicioId = $quote->sections->first()['name_service'];
        }
        
        $bandwidths = CommercialBandwidth::all();
        $bandwidthIds = $quote->tariffs->map(function($detailsQuoteTariff) {
            return $detailsQuoteTariff->bandwidth;
            })->toArray();
            
    
        // dd($bandwidthIds);
        // dd($bandwidths);
        // dd($bandwidths, $quote->tariffs);
        return view('modules.commercial.quotes.edit', compact(
            'quote',
            'tarifas',
            'servicios',
            'bandwidths',
            'bandwidthIds',
            'servicioId',
            'typeDocuments'
        ));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            // Obtener la cotización existente
            $quote = Quotes::findOrFail($id);
            $quote->issue = $request->issue;
            $quote->name = $request->name;
            $quote->type_document_id = $request->type_document_id;
            $quote->identification = $request->identification;
            $quote->email = $request->email;
            $quote->phone = $request->phone;

            $quote->save();


            // Actualizar tarifas existentes o agregar nuevas
            if (is_array($request->bandwidth)) {
                foreach ($request->bandwidth as $index => $bandwidth) {
                    $tariffQuote = DetailsQuotesTariffs::where('quote_id', $quote->id)
                    ->where('bandwidth', $bandwidth)
                    ->first();

                    if ($tariffQuote) {
                        // Actualizar tarifas existentes
                        $tariffQuote->name_service = $tariffQuote->name_service[$index];
                        $tariffQuote->address       = $request->address[$index] ?? null;
                        $tariffQuote->observation   = $request->observation[$index] ?? null;
                        $tariffQuote->nrc_12        = $request->nrc_12[$index];
                        $tariffQuote->nrc_24        = $request->nrc_24[$index];
                        $tariffQuote->nrc_36        = $request->nrc_36[$index];
                        $tariffQuote->mrc_12        = $request->mrc_12[$index];
                        $tariffQuote->mrc_24        = $request->mrc_24[$index];
                        $tariffQuote->mrc_36        = $request->mrc_36[$index];
                    } else {
                        // Crear nuevas tarifas
                        $tariffQuote                            = new DetailsQuotesTariffs();
                        $tariffQuote->quote_id                  = $quote->id;
                        $tariffQuote->name_service              = $tariffQuote->name_service[$index];
                        $tariffQuote->bandwidth                 = $bandwidth;
                        $tariffQuote->address                   = $request->address[$index] ?? null;
                        $tariffQuote->observation               = $request->observation[$index] ?? null;
                        $tariffQuote->nrc_12                    = $request->nrc_12[$index];
                        $tariffQuote->nrc_24                    = $request->nrc_24[$index];
                        $tariffQuote->nrc_36                    = $request->nrc_36[$index];
                        $tariffQuote->mrc_12                    = $request->mrc_12[$index];
                        $tariffQuote->mrc_24                    = $request->mrc_24[$index];
                        $tariffQuote->mrc_36                    = $request->mrc_36[$index];
                    }

                    $tariffQuote->save();
                }
            }

            // Actualizar secciones existentes o agregar nuevas
            $camposRelevantes = ['tramo', 'trayecto'];

            $seccionesPresentes = false;
            foreach ($camposRelevantes as $campo) {
                if ($request->has($campo) && is_array($request->$campo)) {
                    $seccionesPresentes = true;
                    break;
                }
            }
            if ($seccionesPresentes) {
                // Obtener las secciones actuales
                $existingSections = DetailsQuotesSection::where('quote_id', $quote->id)->get()->keyBy('id');
            
                $cantidadSecciones = count($request->tramo);
                for ($index = 0; $index < $cantidadSecciones; $index++) {
                    $sectionId = $request->section_id[$index] ?? null; // Asegúrate de que `section_id` esté presente en el formulario
                    $sectionQuote = $existingSections->get($sectionId) ?: new DetailsQuotesSection();
            
                    $sectionQuote->quote_id = $quote->id;
                    $sectionQuote->name_service = $sectionQuote->name_service[$index];
                    $sectionQuote->tramo = $request->tramo[$index] ?? null;
                    $sectionQuote->trayecto = $request->trayecto[$index] ?? null;
                    $sectionQuote->hilos = $request->hilos[$index] ?? null;
                    $sectionQuote->extremo_a = $request->extremo_a[$index] ?? null;
                    $sectionQuote->extremo_b = $request->extremo_b[$index] ?? null;
                    $sectionQuote->kms = $request->kms[$index] ?? null;
                    $sectionQuote->recurrente_mes = $request->recurrente_mes[$index] ?? null;
                    $sectionQuote->recurrente_12 = $request->recurrente_12[$index] ?? null;
                    $sectionQuote->recurrente_24 = $request->recurrente_24[$index] ?? null;
                    $sectionQuote->recurrente_36 = $request->recurrente_36[$index] ?? null;
                    $sectionQuote->tiempo = $request->tiempo[$index] ?? null;
                    $sectionQuote->valor_km_usd = $request->valor_km_usd[$index] ?? null;
                    $sectionQuote->valor_total_iru_usd = $request->valor_total_iru_usd[$index] ?? null;
                    $sectionQuote->valor_km_cop = $request->valor_km_cop[$index] ?? null;
                    $sectionQuote->valor_total = $request->valor_total[$index] ?? null;
                    $sectionQuote->observation = $request->observation[$index] ?? null;
            
                    $sectionQuote->save();
            
                    // Eliminar la sección de la lista de existentes para poder identificar las eliminadas
                    if ($sectionId) {
                        $existingSections->forget($sectionId);
                    }
                }
            
                // Eliminar las secciones que no están en el request
                foreach ($existingSections as $section) {
                    $section->delete();
                }
            }

            DB::commit();
            Alert::success('Bien hecho!', 'Registro actualizado correctamente');
            return redirect()->route('commercial.quotes.index');
        } catch (PDPException $e) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar el registro.');
            return redirect()->back();
        }
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