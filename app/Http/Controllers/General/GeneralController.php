<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\City;
use App\Models\General\Department;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities(Request $request)
    {
        return City::departmentId($request->departmentId)->get();
    }


    public function departments(Request $request)
    {
        return Department::countryId($request->countryId)->get();
    }
}
