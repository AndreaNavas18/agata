<?php

use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\Customers\CustomerServiceController;
use App\Http\Controllers\Customers\CustomerTicketController;
use App\Http\Controllers\Customers\CustomerUserController;
use App\Http\Controllers\Customers\CustomerProyectoController;

Route::middleware(['can:customers.index'])->namespace('Customers')->name('customers.')->group(function () {

	Route::get('/clientes', [ CustomerController::class, 'index' ])->name('index')
		->middleware('can:customers.index');

	Route::get('/clientes/crear', [ CustomerController::class, 'create' ])->name('create')
		->middleware('can:customers.create');

	Route::post('/clientes/crear',[ CustomerController::class, 'store' ])->name('store')
		->middleware('can:customers.create');

	Route::get('/clientes/ver/{id}', [ CustomerController::class, 'show' ])->name('show')
		->where('id', '[0-9]+')
		->middleware('can:customers.show');

	Route::get('/clientes/editar/{id}', [ CustomerController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:customers.edit');

	Route::put('/clientes/editar/{id}', [ CustomerController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:customers.edit');

	Route::delete('/clientes/eliminar/{id}', [ CustomerController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:customers.destroy');


	Route::get('/clientes/contacto/eliminar/{id}', [ CustomerController::class, 'contactDestroy' ])->name('contacts.destroy')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.contacts.destroy');


	Route::get('/clientes/buscar', [ CustomerController::class, 'search' ])->name('search')
		->middleware('can:customers.search');


    /**********************
    *--------- servicios
    ***********************/

    Route::get('/clientes/servicios/editar/{customerId}', [ CustomerServiceController::class, 'index' ])->name('services.index')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.services.index');

    Route::get('/clientes/servicios/editar/buscar/{customerId}', [ CustomerServiceController::class, 'indexSearch' ])->name('services.index.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.services.index');

    Route::get('/clientes/servicios/ver/{customerId}', [ CustomerServiceController::class, 'show' ])->name('services.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.services.index');

    Route::get('/clientes/servicios/ver/buscar/{customerId}', [ CustomerServiceController::class, 'showSearch' ])->name('services.show.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.services.show');

    Route::post('/clientes/servicios/crear/{customerId}',[ CustomerServiceController::class, 'store' ])->name('services.store')
    ->middleware('can:customers.services.create');

    Route::put('/clientes/servicios/editar/{id}', [ CustomerServiceController::class, 'update' ])->name('services.update')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.services.edit');

    Route::get('/clientes/servicios/eliminar/{id}', [ CustomerServiceController::class, 'destroy' ])->name('services.destroy')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.services.destroy');

    Route::get('/clientes/servicios/editarServicio/{id}', [ CustomerServiceController::class, 'edit' ])->name('services.edit');

    Route::put('/clientes/servicios/editarServicio/{id}', [ CustomerServiceController::class, 'updateService' ])->name('services.updateService');

    Route::get('/clientes/servicios/editarConfiguracion/{id}', [ CustomerServiceController::class, 'editConfig' ])->name('services.editConfig');

    Route::put('/clientes/servicios/editarConfiguracion/{id}', [ CustomerServiceController::class, 'updateConfig' ])->name('services.updateConfig');
    
    //Ruta para buscar servicios
    Route::get('servicios/index/buscar', [ CustomerServiceController::class, 'serviceSearch' ])->name('services.index.buscar');
    
    
    //Ruta para importar servicios
    Route::post('/servicios/index/importar', [ CustomerServiceController::class, 'import' ])->name('services.import');
    
    Route::get('/clientes/servicios/descargar/archivo/{id}', [ CustomerServiceController::class, 'downloadFile' ])->name('services.download.file');

	Route::get('/clientes/servicios/eliminar-archivo/{id}', [ CustomerServiceController::class, 'deleteFile' ])->name('services.delete.file');


    /**********************
    *--------- tickets
    ***********************/
    //edición cliente - tickets
    Route::get('/clientes/tickets/editar/{customerId}', [ CustomerTicketController::class, 'edit' ])->name('tickets.edit')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.tickets.edit');

    Route::get('/clientes/tickets/editar/buscar/{customerId}', [ CustomerTicketController::class, 'editSearch' ])->name('tickets.edit.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.tickets.edit');

    //ver cliente - tickets
    Route::get('/clientes/tickets/ver/{customerId}', [ CustomerTicketController::class, 'show' ])->name('tickets.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.tickets.edit');

    Route::get('/clientes/tickets/ver/buscar/{customerId}', [ CustomerTicketController::class, 'showSearch' ])->name('tickets.show.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.tickets.edit');

    
    /**********************
    *--------- proyectos
    ***********************/

    Route::get('/clientes/proyectos/editar/{customerId}', [ CustomerProyectoController::class, 'index' ])->name('proyectos.index')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.projects.index');

    Route::get('/clientes/proyectos/editar/buscar/{customerId}', [ CustomerProyectoController::class, 'indexSearch' ])->name('proyectos.index.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.projects.index');

    Route::get('/clientes/proyectos/ver/{customerId}', [ CustomerProyectoController::class, 'show' ])->name('proyectos.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.proyectos.show');

    Route::get('/clientes/proyectos/ver/buscar/{customerId}', [ CustomerProyectoController::class, 'showSearch' ])->name('proyectos.show.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.proyectos.show');

    Route::post('/clientes/proyectos/crear/{customerId}',[ CustomerProyectoController::class, 'store' ])->name('proyectos.store')
    ->middleware('can:customers.proyectos.create');

    Route::put('/clientes/proyectos/editar/{id}', [ CustomerProyectoController::class, 'update' ])->name('proyectos.update')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.proyectos.create');

    Route::get('/clientes/proyectos/eliminar/{id}', [ CustomerProyectoController::class, 'destroy' ])->name('proyectos.destroy')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.proyectos.destroy');

    Route::get('/proyectos/show/{id}', [ CustomerProyectoController::class, 'showProyecto' ])->name('proyectos.show.proyecto')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.proyectos.show');
    
    Route::get('/clientes/proyectos/editarproyecto/{id}', [ CustomerProyectoController::class, 'edit' ])->name('proyectos.edit')
    ->where('id', '[0-9]+')
    ->middleware('can:proyectos.edit');

	Route::post('/clientes/asignarServicio', [ CustomerProyectoController::class, 'asignarServicio' ])->name('proyectos.asignarServicio')
    ->middleware('can:customers.proyectos.asignarServicio');


    Route::get('/clientes/proyectos/getServicios/{id}', [ CustomerProyectoController::class, 'getServices' ])->name('proyectos.getServices');

    //Rutas AJAX
    Route::get('/obtener-proyecto-seleccionado', [CustomerProyectoController::class, 'obtenerProyectoSeleccionado'])->name('ruta_para_obtener_proyecto_seleccionado');

     /**********************
    *--------- usuarios
    ***********************/
    Route::get('/clientes/usuarios/editar/{customerId}', [ CustomerUserController::class, 'index' ])->name('users.index')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.users.index');

    Route::get('/clientes/usuarios/ver/{customerId}', [ CustomerUserController::class, 'show' ])->name('users.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.users.index');

    Route::post('/clientes/usuarios/guardar/{customerId}', [ CustomerUserController::class, 'store' ])->name('users.store')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.users.index');

    Route::put('/clientes/usuarios/actualizar/{customerId}', [ CustomerUserController::class, 'update' ])->name('users.update')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.users.index');


});

Route::namespace('Customers')->name('customers.')->group(function () {

    Route::get('/proyectos/index', [ CustomerProyectoController::class, 'indexAll' ])->name('proyectos.index.all')
    ->where('id', '[0-9]+')
    ->middleware('can:proyectos.index');

});