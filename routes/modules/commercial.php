<?php


//use Illuminate\Routing\Route;

use App\Http\Controllers\Commercial\CommercialBandwidthController;
use App\Http\Controllers\Commercial\CommercialTariffController;
use App\Http\Controllers\Commercial\CommercialTypeServiceController;

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

