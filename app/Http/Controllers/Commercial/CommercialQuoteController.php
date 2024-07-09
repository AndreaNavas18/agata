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
use App\Models\General\City;
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
        \Log::info('Datos DE LA COTIZACION recibidos STORE:', $request->all());

        try {
            $observations = $request->input('observation_hidden');
            // Validación de los datos de la cotización
            $request->validate([
                'issue' => 'nullable|string|max:255',
                'name' => 'required|string|max:255',
                'type_document_id' => 'nullable|integer',
                'identification' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255',
                'phone' => 'nullable|string|max:255',
            ]);

            \Log::info('tipo documentoqqq: ' . $request->type_document_id);
        
            // Crear la cotización
            $quote = Quotes::create([
                'issue' => $request->issue,
                'name' => $request->name,
                'type_document_id' => $request->type_document_id,
                'identification' => $request->identification,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        
            // Guardar servicios en la tabla intermedia
            if (!empty($request->commercial_type_service_id)) {
                \Log::info('Servicios si se recibieron');
                foreach ($request->commercial_type_service_id as $index => $commercial_type_service_id) {
                    if ($commercial_type_service_id) {

                        $tariff = CommercialTariff::where('commercial_type_service_id', $commercial_type_service_id)
                        ->where('bandwidth_id', $request->bandwidth_id[$index])
                        ->first();

                        // dd($tariff);
                        
                        if($tariff){
                            \Log::info('Tariff IDDDDqq: ' . $tariff->id);
                            // \Log::info('Observation: ' . $request->observation[$index]);

                            $tariffQuote = new DetailsQuotesTariffs();
                            $tariffQuote->quote_id = $quote->id;
                            $tariffQuote->tariff_id = $tariff->id;
                            $tariffQuote->address = $request->address[$index] ?? null;
                            $tariffQuote->observation = $observations[$index] ?? null;
                            $tariffQuote->nrc_12 = $request->nrc_12[$index] ?? null;
                            $tariffQuote->nrc_24 = $request->nrc_24[$index] ?? null;
                            $tariffQuote->nrc_36 = $request->nrc_36[$index] ?? null;
                            $tariffQuote->mrc_12 = $request->mrc_12[$index] ?? null;
                            $tariffQuote->mrc_24 = $request->mrc_24[$index] ?? null;
                            $tariffQuote->mrc_36 = $request->mrc_36[$index] ?? null;
                            $tariffQuote->save();

                        }else {
                            \Log::warning('No se encontró la tarifa para el servicio ID: ' . $commercial_type_service_id . ' y ancho de banda ID: ' . $request->bandwidth_id[$index]);
                        }

                    }
                }
            } else{
                \Log::info('Servicios no se recibieron');
            }
        
            // Guardar tramos en la tabla intermedia
            if (!empty($request->tramo) || !empty($request->trayecto)) {
                \Log::info('Tramos o trayectos si se recibieron');
                foreach ($request->tramo as $index => $tramo) {
                    $trayecto = $request->trayecto[$index];
                    if (!empty($tramo) || !empty($trayecto)) {
                        \Log::info('Guardando tramo para el índice: ' . $index);
                            $sectionQuote = new DetailsQuotesSection();
                            $sectionQuote->quote_id = $quote->id;
                            $sectionQuote->service_id = $request->service_id[$index];
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
                            \Log::info('Tramo guardado con éxito para el índice: ' . $index);
                        }

                    }
            }else {
                \Log::info('Tramos no se recibieron');
            }

            return redirect()->route('commercial.quotes.index')->with('success', 'Registro insertado correctamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al insertar el registro');
        }
        
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
        $quote = Quotes::findOrFail($id);
        // $tariff = DetailsQuotesTariffs::where('quote_id', $id)->get();
        $tariff = DetailsQuotesTariffs::with('tariff.comercialTypeService')->where('quote_id', $id)->get();
        $section = DetailsQuotesSection::where('quote_id', $id)->get();
        $services = CommercialTypeService::all();
        $bandwidths = CommercialBandwidth::all();
        $tariffComplete = CommercialTariff::all();
        $typeDocuments = TypeDocument::all();

        return view('modules.commercial.quotes.manage', compact(
          'quote', 'tariff', 'section', 'services', 'bandwidths', 'typeDocuments'
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

    public function edit ($id) 
    {
        $quote = Quotes::with([
            'tariffs' => function ($query) use ($id) {
                $query->where('details_quotes_tariffs.quote_id', $id);
            },
            'tariffs.details' => function ($query) use ($id) {
                $query->where('quote_id', $id);
            },
            'tariffs.bandwidth',
            'sections'
        ])->findOrFail($id);
    
        // Verificación adicional
        $filteredTariffs = $quote->tariffs->filter(function ($tariff) use ($id) {
            return $tariff->details->where('quote_id', $id)->count() > 0;
        });

        $tarifas = CommercialTariff::all();
        $servicios = CommercialTypeService::all();
        $typeDocuments = TypeDocument::all();
        $bandwidths = CommercialBandwidth::all();
        $departamentos = Department::all();
        $cities = City::all();
    
        $bandwidthIds = $quote->tariffs->pluck('bandwidth_id')->toArray();
    
        if ($quote->tariffs->isNotEmpty()) {
            $servicioId = $quote->tariffs->first()->commercial_type_service_id;
        } else {
            $servicioId = optional($quote->sections->first())->commercial_type_service_id;
        }

        return view('modules.commercial.quotes.edit', compact(
            'quote',
            'tarifas',
            'servicios',
            'bandwidths',
            'bandwidthIds',
            'servicioId',
            'typeDocuments',
            'departamentos',
            'cities',
            'filteredTariffs'
        ));
    }

    public function update(Request $request, $id)
    {
        \Log::info('Datos de la cotización recibidos UPDATE:', $request->all());

        try {
            $observations = $request->input('observation');

            // Validación de los datos de la cotización
            $request->validate([
                'issue' => 'nullable|string|max:255',
                'name' => 'required|string|max:255',
                'type_document_id' => 'nullable|integer',
                'identification' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255',
                'phone' => 'nullable|string|max:255',
            ]);

            \Log::info('tipo documento: ' . $request->type_document_id);

            // Buscar la cotización existente
            $quote = Quotes::findOrFail($id);

            // Actualizar la cotización
            $quote->update([
                'issue' => $request->issue,
                'name' => $request->name,
                'type_document_id' => $request->type_document_id,
                'identification' => $request->identification,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            // Eliminar las tarifas y tramos existentes para la cotización
            DetailsQuotesTariffs::where('quote_id', $quote->id)->delete();
            $quote->sections()->delete();

            // Guardar servicios en la tabla intermedia
            if (!empty($request->commercial_type_service_id)) {
                \Log::info('Servicios si se recibieron');
                foreach ($request->commercial_type_service_id as $index => $commercial_type_service_id) {
                    if ($commercial_type_service_id) {
                        $tariff = CommercialTariff::where('commercial_type_service_id', $commercial_type_service_id)
                            ->where('bandwidth_id', $request->bandwidth_id[$index])
                            ->first();

                        if ($tariff) {
                            \Log::info('Tariff ID: ' . $tariff->id);

                            $tariffQuote = new DetailsQuotesTariffs();
                            $tariffQuote->quote_id = $quote->id;
                            $tariffQuote->tariff_id = $tariff->id;
                            $tariffQuote->address = $request->address[$index] ?? null;
                            $tariffQuote->observation = $observations[$index] ?? null;
                            $tariffQuote->nrc_12 = $request->nrc_12[$index] ?? null;
                            $tariffQuote->nrc_24 = $request->nrc_24[$index] ?? null;
                            $tariffQuote->nrc_36 = $request->nrc_36[$index] ?? null;
                            $tariffQuote->mrc_12 = $request->mrc_12[$index] ?? null;
                            $tariffQuote->mrc_24 = $request->mrc_24[$index] ?? null;
                            $tariffQuote->mrc_36 = $request->mrc_36[$index] ?? null;
                            $tariffQuote->save();
                        } else {
                            \Log::warning('No se encontró la tarifa para el servicio ID: ' . $commercial_type_service_id . ' y ancho de banda ID: ' . $request->bandwidth_id[$index]);
                        }
                    }
                }
            } else {
                \Log::info('Servicios no se recibieron');
            }

            // Guardar tramos en la tabla intermedia
            if (!empty($request->tramo) || !empty($request->trayecto)) {
                \Log::info('Tramos o trayectos si se recibieron');
                foreach ($request->tramo as $index => $tramo) {
                    $trayecto = $request->trayecto[$index];
                    if (!empty($tramo) || !empty($trayecto)) {
                        \Log::info('Guardando tramo para el índice: ' . $index);
                        $sectionQuote = new DetailsQuotesSection();
                        $sectionQuote->quote_id = $quote->id;
                        $sectionQuote->service_id = $request->service_id[$index];
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
                        \Log::info('Tramo guardado con éxito para el índice: ' . $index);
                    }
                }
            } else {
                \Log::info('Tramos no se recibieron');
            }

            return redirect()->route('commercial.quotes.index')->with('success', 'Registro actualizado correctamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al actualizar el registro');
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