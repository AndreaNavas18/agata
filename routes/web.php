<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Route::get('/email', function () {
//     return view('email');
// });

/*
|-----------------------------------
| Login - Recuperar Contraseña
|-----------------------------------
*/


Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');


Route::middleware(['auth'])->group(function () {

	/*
	|-----------------------------------
	| Home
	|-----------------------------------
	*/
	Route::get('/home', [HomeController::class, 'index'])->name('home');

	/*
	|-----------------------------------
	| Submódulos
	|-----------------------------------
	*/
	require base_path('routes/modules/submodules.php');

	/*
	|-----------------------------------
	| Emails
	|-----------------------------------
	*/
	require base_path('routes/modules/emails.php');

	/*
	|-----------------------------------
	| Permisos y Roles
	|-----------------------------------
	*/
	require base_path('routes/modules/permissions.php');

	/*
	|-----------------------------------
	| Usuarios
	|-----------------------------------
	*/
	require base_path('routes/modules/users.php');

    /*
	|-----------------------------------
	| Clientes
	|-----------------------------------
	*/
	require base_path('routes/modules/customers.php');

    /*
	|-----------------------------------
	| Empleados
	|-----------------------------------
	*/
	require base_path('routes/modules/employees.php');

    /*
	|-----------------------------------
	| Proveedores
	|-----------------------------------
	*/
	require base_path('routes/modules/providers.php');

	/*
	|-----------------------------------
	| parametros
	|-----------------------------------
	*/
	require base_path('routes/modules/parameters.php');


    /*
	|-----------------------------------
	| tickets
	|-----------------------------------
	*/
	require base_path('routes/modules/tickets.php');


    /*
	|-----------------------------------
	| servicios
	|-----------------------------------
	*/
	require base_path('routes/modules/services.php');


    /*
	|-----------------------------------
	| general
	|-----------------------------------
	*/
	require base_path('routes/modules/general.php');


    /*
	|-----------------------------------
	| comercial
	|-----------------------------------
	*/
	require base_path('routes/modules/commercial.php');





    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


    /***************************************************
     * --------- Rutas para el usuario de los clientes
    ******************************************************
    *****************************************************/
    require base_path('routes/modules/customerRole.php');

});


