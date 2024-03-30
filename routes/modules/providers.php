<?php

use App\Http\Controllers\Providers\ProviderController;
use App\Http\Controllers\Providers\ProviderServiceController;
use App\Http\Controllers\Providers\ProviderTicketController;

Route::middleware(['can:providers.index'])->namespace('Providers')->name('providers.')->group(function () {

	Route::get('/proveedores', [ ProviderController::class, 'index' ])->name('index')
		->middleware('can:providers.index');

	Route::get('/proveedores/crear', [ ProviderController::class, 'create' ])->name('create')
		->middleware('can:providers.create');

	Route::post('/proveedores/crear',[ ProviderController::class, 'store' ])->name('store')
		->middleware('can:providers.create');

	Route::get('/proveedores/ver/{id}', [ ProviderController::class, 'show' ])->name('show')
		->where('id', '[0-9]+')
		->middleware('can:providers.show');

	Route::get('/proveedores/editar/{providerId}', [ ProviderController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:providers.edit');

	Route::put('/proveedores/editar/{id}', [ ProviderController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:providers.edit');

	Route::delete('/proveedores/eliminar/{id}', [ ProviderController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:providers.destroy');


	Route::get('/proveedores/contacto/eliminar/{id}', [ ProviderController::class, 'contactDestroy' ])->name('contacts.destroy')
    ->where('id', '[0-9]+')
    ->middleware('can:customers.contacts.destroy');

	Route::get('/proveedores/buscar', [ ProviderController::class, 'search' ])->name('search')
		->middleware('can:providers.search');

    Route::post('/proveedores/index/importar', [ ProviderController::class, 'import' ])->name('import');
    
    Route::post('/proveedores/index/importarcontactos', [ ProviderController::class, 'importContact' ])->name('import.contact');



    /**********************
    *--------- servicios
    ***********************/

    Route::get('/proveedores/servicios/{providerId}', [ ProviderServiceController::class, 'index' ])->name('services.index')
    ->where('id', '[0-9]+');

    Route::get('/proveedores/servicios/buscar/{providerId}', [ ProviderServiceController::class, 'indexSearch' ])->name('services.index.search')
    ->where('id', '[0-9]+');

    Route::get('/proveedores/servicios/ver/{providerId}', [ ProviderServiceController::class, 'show' ])->name('services.show')
    ->where('id', '[0-9]+');

    Route::get('/proveedores/servicios/ver/buscar/{providerId}', [ ProviderServiceController::class, 'showSearch' ])->name('services.show.search')
    ->where('id', '[0-9]+');

    Route::post('/proveedores/servicios/crear/{providerId}',[ ProviderServiceController::class, 'store' ])->name('services.store');

    Route::put('/proveedores/servicios/editar/{id}', [ ProviderServiceController::class, 'update' ])->name('services.update')
    ->where('id', '[0-9]+');

    /**********************
    *--------- tickets
    ***********************/
    //edición proveedores - tickets
    Route::get('/proveedores/tickets/editar/{providerId}', [ ProviderTicketController::class, 'edit' ])->name('tickets.edit')
    ->where('id', '[0-9]+');

    Route::get('/proveedores/tickets/editar/buscar/{providerId}', [ ProviderTicketController::class, 'editSearch' ])->name('tickets.edit.search')
    ->where('id', '[0-9]+');

    //ver proveedores - tickets
    Route::get('/proveedores/tickets/ver/{providerId}', [ ProviderTicketController::class, 'show' ])->name('tickets.show')
    ->where('id', '[0-9]+');

    Route::get('/proveedores/tickets/ver/buscar/{providerId}', [ ProviderTicketController::class, 'showSearch' ])->name('tickets.show.search')
    ->where('id', '[0-9]+');

});


