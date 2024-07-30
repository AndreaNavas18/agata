<?php

use App\Http\Controllers\Customers\CustomerServiceController;

Route::namespace('Customers')->name('customers.')->group(function () {

    /**********************
    *--------- servicios
    ***********************/

    Route::get('/servicios/index', [ CustomerServiceController::class, 'indexAll' ])->name('services.index.all')
    ->where('id', '[0-9]+')
    ->middleware('can:services.index');

    Route::get('/servicios/show/{id}', [ CustomerServiceController::class, 'showService' ])->name('services.show.service')
    ->where('id', '[0-9]+')
    ->middleware('can:services.show');

    Route::get('/clientes/servicios/editar/{customerId}', [ CustomerServiceController::class, 'index' ])->name('services.index')
    ->where('id', '[0-9]+')
    ->middleware('can:services.index');

    Route::get('/clientes/servicios/editar/buscar/{customerId}', [ CustomerServiceController::class, 'indexSearch' ])->name('services.index.search')
    ->where('id', '[0-9]+')
    ->middleware('can:services.search');

    Route::get('/servicios/configuracion/show/{id}', [ CustomerServiceController::class, 'showConfig' ])->name('services.show.config');
    
    Route::put('/servicios/configuracion/show/{id}', [ CustomerServiceController::class, 'updateFile' ])->name('services.update.file');

    Route::get('/clientes/servicios/ver/{customerId}', [ CustomerServiceController::class, 'show' ])->name('services.show')
    ->where('id', '[0-9]+')
    ->middleware('can:services.show');

    // Route::get('/clientes/servicios/ver/buscar/{customerId}', [ CustomerServiceController::class, 'showSearch' ])->name('services.show.search')
    // ->where('id', '[0-9]+')
    // ->middleware('can:customers.services.edit');

    Route::post('/clientes/servicios/crear/{customerId?}',[ CustomerServiceController::class, 'store' ])->name('services.store')
    ->middleware('can:services.create');

    // Route::put('/clientes/servicios/editar/{id}', [ CustomerServiceController::class, 'update' ])->name('services.update')
    // ->where('id', '[0-9]+')
    // ->middleware('can:customers.services.edit');

	Route::delete('/servicios/eliminar/{id}', [ CustomerServiceController::class, 'destroy' ])->name('services.destroy')
    ->where('id', '[0-9]+')
    ->middleware('can:services.destroy');



});


