<?php

use App\Http\Controllers\Pqrs\PqrController;

Route::namespace('Pqrs')->name('pqrs.')->group(function () {

	Route::get('/pqrs', [ PqrController::class, 'index' ])->name('index');

	Route::get('/pqrs/crear', [ PqrController::class, 'create' ])->name('create');

	Route::post('/pqrs/crear',[ PqrController::class, 'store' ])->name('store');

	Route::get('/pqrs/ver/{id}', [ PqrController::class, 'show' ])->name('show');

    Route::get('/pqrs/editar/{pqrId}', [ PqrController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:providers.edit');

	Route::put('/pqrs/editar/{id}', [ PqrController::class, 'update' ])->name('update');

    //EL EDITAR SE PODRA PARA CAMBIAR EL ESTADO DE LA PQR
	// Route::put('/PQRS/editar/{id}', [ PqrController::class, 'update' ])->name('update')
	// 	->where('id', '[0-9]+');

	Route::delete('/pqrs/eliminar/{id}', [ PqrController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+');

	Route::get('/pqrs/buscar', [ PqrController::class, 'pqrSearch' ])->name('search');
});


