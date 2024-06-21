<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Commercial\CommercialBandwidth;
use App\Models\Commercial\CommercialTariff;
use App\Models\Commercial\CommercialTypeService;
use App\Models\Employees\EmployeeArl;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Imports\TariffImport;

class CommercialTariffController extends Controller
{
    public function index(Request $request)
    {
        // Devolver la vista 'modules.commercial.tariff.index' con los datos necesarios

        $tariffs = CommercialTariff::all();
        $typeServices = CommercialTypeService::all();
        $bandwidths = CommercialBandwidth::all();

        return view('modules.commercial.tariff.index', compact('tariffs', 'typeServices', 'bandwidths'));
    }

    public function create()
    {
        $typeServices = CommercialTypeService::all();
        $bandwidths = CommercialBandwidth::all();

        return view('modules.commercial.tariff.create',
            compact('typeServices', 'bandwidths')
        );
    }


    public function store(Request $request)
    {

        // $tariff = new CommercialTariff();
        // $tariff->commercial_type_service_id = $request->commercial_type_service_id;
        // $tariff->bandwidth_id               = $request->bandwidth_id ;
        // $tariff->recurring_value            = $request->recurring_value;
        // $tariff->months                     = $request->months;
        // $tariff->value_Mbps                 = $request->value_Mbps;


        // Itera sobre los valores de los campos
        foreach ($request->commercial_type_service_id as $key => $commercial_type_service_id) {
            // Crea una nueva instancia de CommercialTariff
            $tariff = new CommercialTariff();
            // Asigna los valores de los campos
            $tariff->commercial_type_service_id = $commercial_type_service_id;
            $tariff->bandwidth_id = $request->bandwidth_id[$key];
            $tariff->recurring_value_12 = $request->recurring_value_12[$key];
            $tariff->recurring_value_24 = $request->recurring_value_24[$key];
            $tariff->recurring_value_36 = $request->recurring_value_36[$key];
            $tariff->value_mbps_12 = $request->value_mbps_12[$key];
            $tariff->value_mbps_24 = $request->value_mbps_24[$key];
            $tariff->value_mbps_36 = $request->value_mbps_36[$key];

            // Guarda el objeto CommercialTariff en la base de datos
            $tariff->save();
        }




        if (!$tariff->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }


        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');

        return redirect()->route('tariff.index')->with('tariff', $tariff);
    }

    public function addFields()
    {

        $typeServices = CommercialTypeService::all();
        $bandwidths = CommercialBandwidth::all();
        return view(
            'modules/commercial/tariff/partials/form',
            compact('typeServices', 'bandwidths')
        );
    }

    public function parameters(){
        return view('modules/commercial/parameters/tariff');

    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            if (!CommercialTariff::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
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

    public function show($id)
    {
        $tariff = CommercialTariff::findOrFail($id);
        
        return view('modules/commercial/tariff/show', compact('tariff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   public function edit($id)
   {

        $typeServices = CommercialTypeService::all();
        $bandwidths = CommercialBandwidth::all();
        $tariff = CommercialTariff::findOrFail($id);
       return view('modules/commercial/tariff/edit', compact(
           'typeServices',
           'bandwidths',
           'tariff'
       ));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
       DB::beginTransaction();
       
       // Crea una nueva instancia de CommercialTariff
       $tariff = CommercialTariff::findOrFail($id);
       
        // Itera sobre los valores de los campos
        foreach ($request->commercial_type_service_id as $key => $commercial_type_service_id) {
            // Asigna los valores de los campos
            $tariff->commercial_type_service_id = $commercial_type_service_id;
            $tariff->bandwidth_id = $request->bandwidth_id[$key];
            $tariff->recurring_value_12 = $request->recurring_value_12[$key];
            $tariff->recurring_value_24 = $request->recurring_value_24[$key];
            $tariff->recurring_value_36 = $request->recurring_value_36[$key];
            $tariff->value_mbps_12 = $request->value_mbps_12[$key];
            $tariff->value_mbps_24 = $request->value_mbps_24[$key];
            $tariff->value_mbps_36 = $request->value_mbps_36[$key];

            // Guarda el objeto CommercialTariff en la base de datos
            // $tariff->save();
        }

       if (!$tariff->save()) {
           DB::rollBack();
           Alert::error('Error', 'Error al actualizar el registro.');
           return redirect()->back();
       }

       DB::commit();
       Alert::success('¡Éxito!', 'Registro actualizado correctamente');
       return redirect()->route('tariff.index');
   }

       //Busqueda funcional para las tarifas

       public function search(Request $request) 
       {
            $data=$request->all();

            $typeServices = CommercialTypeService::all();
            $bandwidths = CommercialBandwidth::all();

            $tariffs= CommercialTariff::buscarTarifas($data);
                $tariffs = $tariffs->paginate();
                return view('modules.commercial.tariff.index', compact(
                    
                'tariffs', 
                'typeServices', 
                'bandwidths',
                'data'
                ));
        }

        public function import(Request $request)
        {
            if($request->hasFile('tariffdocumento')){

                $file = $request->file('tariffdocumento');
                Excel::import(new TariffImport, $file);
                Log::info("funcione, importe las tarifas");

                Alert::success('Bien hecho!', 'Tarifas importada(s) correctamente');
                return redirect()->back();

                
            }else {
                Alert::error('Error', 'Error al importar archivo.');
                Log::info("no funcioneeee");
                return redirect()->back();
            }
        }
}
