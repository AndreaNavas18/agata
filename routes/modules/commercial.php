<?php


//use Illuminate\Routing\Route;

use App\Http\Controllers\Commercial\CommercialTariffController;

//TARIFARIO//
Route::namespace('Commercial')->name('tariff.')->group(function () {

    Route::get('/tarifario', [CommercialTariffController::class, 'index'])->name('index');

    Route::get('/tarifa/crear', [ CommercialTariffController::class, 'create' ])->name('create')
    ->middleware('can:commercial.create');

    Route::post('/tarifa/crear',[ CommercialTariffController::class, 'store' ])->name('store')
    ->middleware('can:commercial.create');

    Route::get('/additional_fields',[ CommercialTariffController::class, 'addCampos' ])->name('addCampos')
    ->middleware('can:commercial.create');

});
