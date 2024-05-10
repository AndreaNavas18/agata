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

    public function enviarCorreo(Request $request){
        $nombre         = $request->nombre;
        $empresa        = $request->empresa;
        $pais           = $request->pais;
        $provincia      = $request->provincia;
        $telefono       = $request->telefono;
        $correo         = $request->correo;
        $asunto         = $request->asunto;
        $mensaje        = $request->mensaje;

        Mail::to('knavas@stratecsa.com')->send(new webCorreo($nombre, $empresa, $pais, $provincia, $telefono, $correo, $asunto, $mensaje));
        
        Log::info("Si se envio el correo");

        return response()->json([
            'message' => 'Correo enviado'
        ]);


    }

    public function correo($request) {

        Mail::to('knavas@stratecsa.com')->send(new webCorreo($request->all()));
        
        Log::info("Si se envio el correo");

        return response()->json([
            'message' => 'Correo enviado'
        ]);


    }
}
