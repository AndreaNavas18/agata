<?php

use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\Customers\CustomerServiceController;
use App\Http\Controllers\Customers\CustomerTicketController;
use App\Http\Controllers\Customers\CustomerUserController;

Route::middleware(['can:customers_show'])->namespace('Customers')->name('customers.')->group(function () {

	Route::get('/clientes', [ CustomerController::class, 'index' ])->name('index')
		->middleware('can:customers_show');

	Route::get('/clientes/crear', [ CustomerController::class, 'create' ])->name('create')
		->middleware('can:customers_create');

	Route::post('/clientes/crear',[ CustomerController::class, 'store' ])->name('store')
		->middleware('can:customers_create');

	Route::get('/clientes/ver/{id}', [ CustomerController::class, 'show' ])->name('show')
		->where('id', '[0-9]+')
		->middleware('can:customers_show');

	Route::get('/clientes/editar/{id}', [ CustomerController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:customers_edit');

	Route::put('/clientes/editar/{id}', [ CustomerController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:customers_edit');

	Route::delete('/clientes/eliminar/{id}', [ CustomerController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:customers_destroy');


	Route::get('/clientes/contacto/eliminar/{id}', [ CustomerController::class, 'contactDestroy' ])->name('contacts.destroy')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_destroy');


	Route::get('/clientes/buscar', [ CustomerController::class, 'search' ])->name('search')
		->middleware('can:customers_show');


    /**********************
    *--------- servicios
    ***********************/

    Route::get('/clientes/servicios/editar/{customerId}', [ CustomerServiceController::class, 'index' ])->name('services.index')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/clientes/servicios/editar/buscar/{customerId}', [ CustomerServiceController::class, 'indexSearch' ])->name('services.index.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/clientes/servicios/ver/{customerId}', [ CustomerServiceController::class, 'show' ])->name('services.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/clientes/servicios/ver/buscar/{customerId}', [ CustomerServiceController::class, 'showSearch' ])->name('services.show.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::post('/clientes/servicios/crear/{customerId}',[ CustomerServiceController::class, 'store' ])->name('services.store')
    ->middleware('can:customers_create');

    Route::put('/clientes/servicios/editar/{id}', [ CustomerServiceController::class, 'update' ])->name('services.update')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    /**********************
    *--------- tickets
    ***********************/
    //edición cliente - tickets
    Route::get('/clientes/tickets/editar/{customerId}', [ CustomerTicketController::class, 'edit' ])->name('tickets.edit')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/clientes/tickets/editar/buscar/{customerId}', [ CustomerTicketController::class, 'editSearch' ])->name('tickets.edit.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    //ver cliente - tickets
    Route::get('/clientes/tickets/ver/{customerId}', [ CustomerTicketController::class, 'show' ])->name('tickets.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/clientes/tickets/ver/buscar/{customerId}', [ CustomerTicketController::class, 'showSearch' ])->name('tickets.show.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    /**********************
    *--------- usuarios
    ***********************/
    Route::get('/clientes/usuarios/editar/{customerId}', [ CustomerUserController::class, 'index' ])->name('users.index')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/clientes/usuarios/ver/{customerId}', [ CustomerUserController::class, 'show' ])->name('users.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');


    Route::post('/clientes/usuarios/guardar/{customerId}', [ CustomerUserController::class, 'store' ])->name('users.store')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::put('/clientes/usuarios/actualizar/{customerId}', [ CustomerUserController::class, 'update' ])->name('users.update')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

});


