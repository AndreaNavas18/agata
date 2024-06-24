<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

use PDPException;

class CommercialOrderServiceController extends Controller
{
    public function index(Request $request)
    {
//En espera

        // session::flash('tab','orderService');
        // $quotes = Quotes::orderBy('id', 'DESC')->paginate();
        // $quotesTariffs = DetailsQuotesTariffs::all();
        // $quotesSections = DetailsQuotesSection::all();

        // return view('modules.commercial.quotes.index', compact('quotes', 'quotesTariffs', 'quotesSections'));
    }
}