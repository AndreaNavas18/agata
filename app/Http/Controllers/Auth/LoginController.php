<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Helpers;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Maneja la autenticación para administrativos
     *e
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        if (Auth::attempt([
            'email'   => $request->input('email'),
            'password' => $request->input('password'),
            'status'   => 'Activo'
        ])) {
        //     if (Auth::user()->role_id==2) {
        //         return redirect()->route('customer.home')->with('info', 'Bienvenido ' . Helpers::capitalizarTextoCompleto(Auth::user()->full_name) . '!');
        //     } else {
                return redirect()->route('home')->with('info', 'Bienvenido ' . Helpers::capitalizarTextoCompleto(Auth::user()->full_name) . '!');
            
            } else
            return redirect()->route('login')->with('error', 'Las credenciales no coinciden ó el usuario se encuentra inactivo.');
    }


     /**
     * Cierra y limpia la información de
     * la sesión del usuario
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('info', '¡Hasta Pronto!');
    }
}
