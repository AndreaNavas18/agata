<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Mail\webCorreo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function enviarCorreo(Request $request) {

        Mail::to('karennavas333@gmail.com')->send(new webCorreo($request->all()));

        return response()->json([
            'message' => 'Correo enviado'
        ]);

        Log::info("Si se envio el correo");

    }
}
