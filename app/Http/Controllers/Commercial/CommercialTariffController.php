<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Commercial\CommercialBandwidth;
use App\Models\Commercial\CommercialTariff;
use App\Models\Commercial\CommercialTypeService;
use App\Models\Employees\EmployeeArl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CommercialTariffController extends Controller
{
    public function index(Request $request)
    {
        // Devolver la vista 'modules.commercial.tariff.index' con los datos necesarios

        $tariffs = CommercialTariff::all();

        return view('modules.commercial.tariff.index', compact('tariffs'));
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
            $tariff->recurring_value = $request->recurring_value[$key];
            $tariff->months = $request->months[$key];
            $tariff->value_Mbps = $request->value_Mbps[$key];

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
}
