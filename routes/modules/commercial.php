<?php


//use Illuminate\Routing\Route;

use App\Http\Controllers\Commercial\CommercialBandwidthController;
use App\Http\Controllers\Commercial\CommercialTariffController;
use App\Http\Controllers\Commercial\CommercialTypeServiceController;
use App\Http\Controllers\Commercial\CommercialQuoteController;
use App\Http\Controllers\Commercial\CommercialOrderServiceController;

//TARIFARIO//
Route::namespace('Commercial')->name('tariff.')->group(function () {

    Route::get('/tarifario', [CommercialTariffController::class, 'index'])->name('index');

    Route::get('/tarifa/crear', [ CommercialTariffController::class, 'create' ])->name('create')
    ->middleware('can:commercial.create');

    Route::post('/tarifa/crear',[ CommercialTariffController::class, 'store' ])->name('store')
    ->middleware('can:commercial.create');

    Route::get('/tarifa/addFields',[ CommercialTariffController::class, 'addFields' ])->name('addFields')
    ->middleware('can:commercial.create');

    Route::get('/tarifario/parametros',[CommercialTariffController::class, 'parameters' ])->name('parameters')
    ->middleware('can:commercial.create');

    Route::delete('/tarifario/eliminar/{id}',[ CommercialTariffController::class, 'destroy' ])->name('destroy')
    ->middleware('can:commercial.destroy')
    ->where('id', '[0-9]+');

    Route::get('/tarifario/show/{id}', [ CommercialTariffController::class, 'show' ])->name('show')
    ->where('id', '[0-9]+')
    ->middleware('can:commercial.show');

    Route::get('/tarifario/editar/{id}', [ CommercialTariffController::class, 'edit' ])->name('edit')
    ->where('id', '[0-9]+')
    ->middleware('can:commercial.edit');

    Route::put('/tarifario/editar/{id}', [ CommercialTariffController::class, 'update' ])->name('update')
    ->where('id', '[0-9]+')
    ->middleware('can:commercial.edit');

    Route::get('/tarifario/buscar', [ CommercialTariffController::class, 'search' ])->name('search')
    ->middleware('can:commercial.search');
});


    //------Parametros Tipo Servicios-------//

Route::middleware(['can:commercial.index'])->namespace('Commercial')->name('tariff.params.')->group(function () {

    Route::get('/tarifario/parametros/servicios',[ CommercialTypeServiceController::class, 'index' ])->name('service.index');

    Route::post('/tarifario/parametros/servicios/crear', [ CommercialTypeServiceController::class, 'store' ])->name('service.store');

    Route::put('/tarifario/parametros/servicios/editar/{id}',[ CommercialTypeServiceController::class, 'update' ])->name('service.update')
    ->where('id', '[0-9]+');

    Route::delete('/tarifario/parametros/servicios/eliminar/{id}',[ CommercialTypeServiceController::class, 'destroy' ])->name('service.destroy')
    ->where('id', '[0-9]+');

    Route::get('/tarifario/parametros/servicios/buscar', [CommercialTypeServiceController::class, 'search'])->name('service.search');

    //------Parametros Bandwidth-------//


    Route::get('/tarifario/parametros/bandwidth',[ CommercialBandwidthController::class, 'index' ])->name('bandwidth.index');
    
    Route::post('/tarifario/parametros/bandwidth/crear', [ CommercialBandwidthController::class, 'store' ])->name('bandwidth.store');
    
    Route::put('/tarifario/parametros/bandwidth/editar/{id}',[ CommercialBandwidthController::class, 'update' ])->name('bandwidth.update')
        ->where('id', '[0-9]+');
    
    Route::delete('/tarifario/parametros/bandwidth/eliminar/{id}',[ CommercialBandwidthController::class, 'destroy' ])->name('bandwidth.destroy')
        ->where('id', '[0-9]+');
    
    Route::get('/tarifario/parametros/bandwidth/buscar', [CommercialBandwidthController::class, 'search'])->name('bandwidth.search');
    
    
});

Route::middleware(['can:commercial.index'])->namespace('Commercial')->name('commercial.quotes.')->group(function () {

    Route::get('/cotizaciones', [CommercialQuoteController::class, 'index'])->name('index');

    Route::get('/cotizaciones/crear', [ CommercialQuoteController::class, 'create' ])->name('create')
    ->middleware('can:commercial.create');

    Route::post('/cotizaciones/crear',[ CommercialQuoteController::class, 'store' ])->name('store')
    ->middleware('can:commercial.create');

	Route::get('/cotizaciones/gestionar/{id}', [ CommercialQuoteController::class, 'manage' ])->name('manage');

	Route::get('/cotizaciones/editar/{quoteId}', [ CommercialQuoteController::class, 'edit' ])->name('edit');

    Route::put('/cotizaciones/editar/{id}', [ CommercialQuoteController::class, 'update' ])->name('update');

	Route::delete('/cotizaciones/eliminar/{id}', [ CommercialQuoteController::class, 'destroy' ])->name('destroy');

	Route::get('/cotizaciones/buscar', [ CommercialQuoteController::class, 'search' ])->name('search');

    Route::get('/quotes/{id}/export', [ CommercialQuoteController::class, 'export' ])->name('export');

});

// AJAX
Route::get('/obtener-anchos-de-banda', [CommercialQuoteController::class, 'obtenerAnchosDeBanda']);
Route::get('/obtener-detalles-ancho-de-banda/{id}', [CommercialQuoteController::class, 'obtenerDetallesAnchoDeBanda']);
Route::get('/obtener-detalles-tarifa', [CommercialQuoteController::class, 'obtenerDetallesTarifa']);
// Route::post('/obtener-detalles-tarifa', [CommercialQuoteController::class, 'obtenerDetallesTarifa']);
Route::get('/obtener-ciudades/{department_id}', [CommercialBandwidthController::class, 'obtenerCiudades']);
Route::get('obtener-tipos-documentos', [CommercialQuoteController::class, 'obtenerTiposDocumentos']);

Route::middleware(['can:commercial.index'])->namespace('Commercial')->name('commercial.')->group(function () {

    Route::post('/bandwidth/index/importar', [ CommercialBandwidthController::class, 'import' ])->name('bandwidth.import');
    
    Route::post('/typeservice/index/importar', [ CommercialTypeServiceController::class, 'import' ])->name('typeservice.import');

    Route::post('/tarifa/index/importar', [ CommercialTariffController::class, 'import' ])->name('tariff.import');

    //Orden de servicio rutas

    Route::get('/ordenes-servicio', [CommercialOrderServiceController::class, 'index'])->name('orderService.index');

});



