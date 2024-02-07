<?php

use App\Http\Controllers\Providers\ProviderController;
use App\Http\Controllers\Providers\ProviderServiceController;
use App\Http\Controllers\Providers\ProviderTicketController;

Route::middleware(['can:proveedores_show'])->namespace('Providers')->name('providers.')->group(function () {

	Route::get('/proveedores', [ ProviderController::class, 'index' ])->name('index')
		->middleware('can:proveedores_show');

	Route::get('/proveedores/crear', [ ProviderController::class, 'create' ])->name('create')
		->middleware('can:proveedores_create');

	Route::post('/proveedores/crear',[ ProviderController::class, 'store' ])->name('store')
		->middleware('can:proveedores_create');

	Route::get('/proveedores/ver/{id}', [ ProviderController::class, 'show' ])->name('show')
		->where('id', '[0-9]+')
		->middleware('can:proveedores_show');

	Route::get('/proveedores/editar/{providerId}', [ ProviderController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:proveedores_edit');

	Route::put('/proveedores/editar/{id}', [ ProviderController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:proveedores_edit');

	Route::delete('/proveedores/eliminar/{id}', [ ProviderController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:proveedores_destroy');


	Route::delete('/proveedores/contacto/eliminar/{id}', [ ProviderController::class, 'contactDestroy' ])->name('contacts.destroy')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_destroy');

	Route::get('/proveedores/buscar', [ ProviderController::class, 'search' ])->name('search')
		->middleware('can:proveedores_show');


    /**********************
    *--------- servicios
    ***********************/

    Route::get('/proveedores/servicios/{providerId}', [ ProviderServiceController::class, 'index' ])->name('services.index')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/proveedores/servicios/buscar/{providerId}', [ ProviderServiceController::class, 'indexSearch' ])->name('services.index.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/proveedores/servicios/ver/{providerId}', [ ProviderServiceController::class, 'show' ])->name('services.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/proveedores/servicios/ver/buscar/{providerId}', [ ProviderServiceController::class, 'showSearch' ])->name('services.show.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::post('/proveedores/servicios/crear/{providerId}',[ ProviderServiceController::class, 'store' ])->name('services.store')
    ->middleware('can:proveedores_create');

    Route::put('/proveedores/servicios/editar/{id}', [ ProviderServiceController::class, 'update' ])->name('services.update')
    ->where('id', '[0-9]+')
    ->middleware('can:proveedores_edit');

    /**********************
    *--------- tickets
    ***********************/
    //edición proveedores - tickets
    Route::get('/proveedores/tickets/editar/{providerId}', [ ProviderTicketController::class, 'edit' ])->name('tickets.edit')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/proveedores/tickets/editar/buscar/{providerId}', [ ProviderTicketController::class, 'editSearch' ])->name('tickets.edit.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    //ver proveedores - tickets
    Route::get('/proveedores/tickets/ver/{providerId}', [ ProviderTicketController::class, 'show' ])->name('tickets.show')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

    Route::get('/proveedores/tickets/ver/buscar/{providerId}', [ ProviderTicketController::class, 'showSearch' ])->name('tickets.show.search')
    ->where('id', '[0-9]+')
    ->middleware('can:customers_edit');

});


