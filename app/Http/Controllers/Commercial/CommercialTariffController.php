<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Commercial\CommercialTariff;
use Illuminate\Http\Request;

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
        return view('modules.commercial.tariff.create');
    }
}
