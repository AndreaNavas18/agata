<?php

/*
|-----------------------------------
| Parámetros
|-----------------------------------
*/

use App\Http\Controllers\Parameters\Employees\EmployeeArlController;
use App\Http\Controllers\Parameters\Employees\EmployeeEpsController;
use App\Http\Controllers\Parameters\Employees\EmployeePensionController;
use App\Http\Controllers\Parameters\Employees\EmployeePositionController;
use App\Http\Controllers\Parameters\Employees\EmployeePositionDepartmentController;
use App\Http\Controllers\Parameters\Employees\EmployeeSeveranceController;
use App\Http\Controllers\Parameters\General\GeneralCityController;
use App\Http\Controllers\Parameters\General\GeneralCountryController;
use App\Http\Controllers\Parameters\General\GeneralDepartmentController;
use App\Http\Controllers\Parameters\General\GeneralServiceController;
use App\Http\Controllers\Parameters\General\GeneralTypePriorityController;
use App\Http\Controllers\Parameters\General\GeneralTypeContactController;
use App\Http\Controllers\Parameters\General\GeneralTypeDocumentController;
use App\Http\Controllers\Parameters\ParameterController;


Route::namespace('Parameters')->name('params.')->group(function () {

	/*
	|-----------------------------------
	| Empleados
	|-----------------------------------
	*/
	Route::get('/parametros/empleados', [ParameterController::class, 'employees'])->name('employees');

	/*
	|-----------------------------------
	| clientes
	|-----------------------------------
	*/
	Route::get('/parametros/general', [ParameterController::class, 'general'])->name('general');


});

/*
	|-------------------------------------------------------------------------
	|------------------------------- Employees ----------------------------------
	|---------------------------------------------------------------------------
*/

/*
|-----------------------------------
| ARL
|-----------------------------------
*/
Route::namespace('Parameters\Employees')->name('params.employees.')->group(function () {

	Route::get('/parametros/empleados/arl', [EmployeeArlController::class, 'index'])->name('arl');

    Route::get('/parametros/empleados/arl/buscar', [EmployeeArlController::class, 'search'])->name('arl.search');

	Route::post('/parametros/empleados/arl/crear',[EmployeeArlController::class, 'store'])->name('arl.store');

	Route::put('/parametros/empleados/arl/editar/{id}',[EmployeeArlController::class, 'update'])->name('arl.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/empleados/arl/eliminar/{id}', [EmployeeArlController::class, 'destroy'])->name('arl.destroy')
		->where('id', '[0-9]+');


    /*
    |-----------------------------------
    | Cargos
    |-----------------------------------
    */
    Route::get('/parametros/empleados/cargos', [EmployeePositionController::class, 'index'])->name('positions');

    Route::get('/parametros/empleados/cargos/buscar', [EmployeePositionController::class, 'buscar'])->name('positions.search');

	Route::post('/parametros/empleados/cargos/crear',[EmployeePositionController::class, 'store'])->name('positions.store');

	Route::put('/parametros/empleados/cargos/editar/{id}',[EmployeePositionController::class, 'update'])->name('positions.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/empleados/cargos/eliminar/{id}', [EmployeePositionController::class, 'destroy'])->name('positions.destroy')
		->where('id', '[0-9]+');


    /*
    |-----------------------------------
    | Cesantias
    |-----------------------------------
    */
    Route::get('/parametros/empleados/cesantias', [EmployeeSeveranceController::class, 'index'])->name('severance');

    Route::get('/parametros/empleados/cesantias/buscar', [EmployeeSeveranceController::class, 'buscar'])->name('severance.search');

	Route::post('/parametros/empleados/cesantias/crear',[EmployeeSeveranceController::class, 'store'])->name('severance.store');

	Route::put('/parametros/empleados/cesantias/editar/{id}',[EmployeeSeveranceController::class, 'update'])->name('severance.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/empleados/cesantias/eliminar/{id}', [EmployeeSeveranceController::class, 'destroy'])->name('severance.destroy')
		->where('id', '[0-9]+');


    /*
    |-----------------------------------
    | departamentos
    |-----------------------------------
    */
    Route::get('/parametros/empleados/departamentos', [EmployeePositionDepartmentController::class, 'index'])->name('departments');

    Route::get('/parametros/empleados/departamentos/buscar', [EmployeePositionDepartmentController::class, 'search'])->name('departments.search');

	Route::post('/parametros/empleados/departamentos/crear',[EmployeePositionDepartmentController::class, 'store'])->name('departments.store');

	Route::put('/parametros/empleados/departamentos/editar/{id}',[EmployeePositionDepartmentController::class, 'update'])->name('departments.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/empleados/departamentos/eliminar/{id}', [EmployeePositionDepartmentController::class, 'destroy'])->name('departments.destroy')
		->where('id', '[0-9]+');



    /*
    |-----------------------------------
    | EPS
    |-----------------------------------
    */
    Route::get('/parametros/empleados/eps', [EmployeeEpsController::class, 'index'])->name('eps');

    Route::get('/parametros/empleados/eps/buscar', [EmployeeEpsController::class, 'search'])->name('eps.search');

	Route::post('/parametros/empleados/eps/crear',[EmployeeEpsController::class, 'store'])->name('eps.store');

	Route::put('/parametros/empleados/eps/editar/{id}',[EmployeeEpsController::class, 'update'])->name('eps.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/empleados/eps/eliminar/{id}', [EmployeeEpsController::class, 'destroy'])->name('eps.destroy')
		->where('id', '[0-9]+');

    /*
    |-----------------------------------
    | pensiones
    |-----------------------------------
    */
    Route::get('/parametros/empleados/pensiones', [EmployeePensionController::class, 'index'])->name('pensions');

    Route::get('/parametros/empleados/pensiones/buscar', [EmployeePensionController::class, 'search'])->name('pensions.search');

	Route::post('/parametros/empleados/pensiones/crear',[EmployeePensionController::class, 'store'])->name('pensions.store');

	Route::put('/parametros/empleados/pensiones/editar/{id}',[EmployeePensionController::class, 'update'])->name('pensions.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/empleados/pensiones/eliminar/{id}', [EmployeePensionController::class, 'destroy'])->name('pensions.destroy')
		->where('id', '[0-9]+');

});



/*
	|-------------------------------------------------------------------------
	|------------------------------- general ----------------------------------
	|---------------------------------------------------------------------------
*/

Route::namespace('Parameters\General')->name('params.general.')->group(function () {

    /*
    |-----------------------------------
    | paises
    |-----------------------------------
    */
    Route::get('/parametros/general/paises', [GeneralCountryController::class, 'index'])->name('countries');

    Route::get('/parametros/general/paises/buscar', [GeneralCountryController::class, 'search'])->name('countries.search');

	Route::post('/parametros/general/paises/crear',[GeneralCountryController::class, 'store'])->name('countries.store');

	Route::put('/parametros/general/paises/editar/{id}',[GeneralCountryController::class, 'update'])->name('countries.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/general/paises/eliminar/{id}', [GeneralCountryController::class, 'destroy'])->name('countries.destroy')
		->where('id', '[0-9]+');

    /*
    |-----------------------------------
    | departamentos
    |-----------------------------------
    */
    Route::get('/parametros/general/departamentos', [GeneralDepartmentController::class, 'index'])->name('departments');

    Route::get('/parametros/general/departamentos/buscar', [GeneralDepartmentController::class, 'search'])->name('departments.search');

	Route::post('/parametros/general/departamentos/crear',[GeneralDepartmentController::class, 'store'])->name('departments.store');

	Route::put('/parametros/general/departamentos/editar/{id}',[GeneralDepartmentController::class, 'update'])->name('departments.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/general/departamentos/eliminar/{id}', [GeneralDepartmentController::class, 'destroy'])->name('departments.destroy')
		->where('id', '[0-9]+');

    /*
    |-----------------------------------
    | ciudades
    |-----------------------------------
    */
    Route::get('/parametros/general/ciudades', [GeneralCityController::class, 'index'])->name('cities');

    Route::get('/parametros/general/ciudades/buscar', [GeneralCityController::class, 'search'])->name('cities.search');

	Route::post('/parametros/general/ciudades/crear',[GeneralCityController::class, 'store'])->name('cities.store');

	Route::put('/parametros/general/ciudades/editar/{id}',[GeneralCityController::class, 'update'])->name('cities.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/general/ciudades/eliminar/{id}', [GeneralCityController::class, 'destroy'])->name('cities.destroy')
		->where('id', '[0-9]+');

    /*
    |-----------------------------------
    | servicios
    |-----------------------------------
    */
    Route::get('/parametros/general/servicios', [GeneralServiceController::class, 'index'])->name('services');

    Route::get('/parametros/general/servicios/buscar', [GeneralServiceController::class, 'search'])->name('services.search');

	Route::post('/parametros/general/servicios/crear',[GeneralServiceController::class, 'store'])->name('services.store');

	Route::put('/parametros/general/servicios/editar/{id}',[GeneralServiceController::class, 'update'])->name('services.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/general/servicios/eliminar/{id}', [GeneralServiceController::class, 'destroy'])->name('services.destroy')
		->where('id', '[0-9]+');


    /*
    |-----------------------------------
    | tipos contactos
    |-----------------------------------
    */
    Route::get('/parametros/general/tipos-contactos', [GeneralTypeContactController::class, 'index'])->name('types_contact');

    Route::get('/parametros/general/tipos-contactos/buscar', [GeneralTypeContactController::class, 'search'])->name('types_contact.search');

	Route::post('/parametros/general/tipos-contactos/crear',[GeneralTypeContactController::class, 'store'])->name('types_contact.store');

	Route::put('/parametros/general/tipos-contactos/editar/{id}',[GeneralTypeContactController::class, 'update'])->name('types_contact.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/general/tipos-contactos/eliminar/{id}', [GeneralTypeContactController::class, 'destroy'])->name('types_contact.destroy')
		->where('id', '[0-9]+');


    /*
    |-----------------------------------
    | tipos documentos
    |-----------------------------------
    */
    Route::get('/parametros/general/tipos-documentos', [GeneralTypeDocumentController::class, 'index'])->name('types_documents');

    Route::get('/parametros/general/tipos-documentos/buscar', [GeneralTypeDocumentController::class, 'search'])->name('types_documents.search');

	Route::post('/parametros/general/tipos-documentos/crear',[GeneralTypeDocumentController::class, 'store'])->name('types_documents.store');

	Route::put('/parametros/general/tipos-documentos/editar/{id}',[GeneralTypeDocumentController::class, 'update'])->name('types_documents.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/general/tipos-documentos/eliminar/{id}', [GeneralTypeDocumentController::class, 'destroy'])->name('types_documents.destroy')
		->where('id', '[0-9]+');

	
	/*
    |-----------------------------------
    | Motivos de solicitud
    |-----------------------------------
    */
    Route::get('/parametros/general/tipos-prioridades', [GeneralTypePriorityController::class, 'index'])->name('types_priorities');

    Route::get('/parametros/general/tipos-prioridades/buscar', [GeneralTypePriorityController::class, 'search'])->name('types_priorities.search');

	Route::post('/parametros/general/tipos-prioridades/crear',[GeneralTypePriorityController::class, 'store'])->name('types_priorities.store');

	Route::put('/parametros/general/tipos-prioridades/editar/{id}',[GeneralTypePriorityController::class, 'update'])->name('types_priorities.update')
		->where('id', '[0-9]+');

	Route::delete('/parametros/general/tipos-prioridades/eliminar/{id}', [GeneralTypePriorityController::class, 'destroy'])->name('types_priorities.destroy')
		->where('id', '[0-9]+');

});



