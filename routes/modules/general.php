<?php

use App\Http\Controllers\General\GeneralController;

Route::namespace('General')->name('general.')->group(function () {

	Route::get('/general/obtener-ciudades', [ GeneralController::class, 'cities' ])->name('cities');

    Route::get('/general/obtener-departamentos', [ GeneralController::class, 'departments' ])->name('departments');

});


