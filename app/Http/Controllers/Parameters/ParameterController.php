<?php

namespace App\Http\Controllers\Parameters;

use App\Http\Controllers\Controller;

class ParameterController extends Controller
{
    /**
     * Muestra la vista con todas las opciones parametrizables
     *
     * @return \Illuminate\Http\Response
     */
    public function employees()
    {
        return view('modules.parameters.employees');
    }


    public function general() {
        return view('modules.parameters.general');
    }

}

