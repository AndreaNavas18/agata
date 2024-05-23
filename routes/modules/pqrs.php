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

    //EL EDITAR SE PODRA PARA CAMBIAR EL ESTADO DE LA PQR (CERRAR SOLO DON JULIAN)
	// Route::put('/PQRS/editar/{id}', [ PqrController::class, 'update' ])->name('update')
	// 	->where('id', '[0-9]+');

	Route::delete('/pqrs/eliminar/{id}', [ PqrController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+');

	Route::get('/pqrs/buscar', [ PqrController::class, 'pqrSearch' ])->name('search');

	Route::get('/PQRS/gestionar/{id}', [ PqrController::class, 'manage' ])->name('manage');

	/**
	 * RUTAS PARA LOS TEMAS DE LOS PQRS
	 */

	Route::get('/pqrs/temas/index', [ PqrController::class, 'indexTema' ])->name('index.tema');

	Route::get('/pqrs/temas/buscar', [ PqrController::class, 'SearchTema' ])->name('search.tema');

	Route::delete('/pqrs/temas/eliminar/{id}', [ PqrController::class, 'destroyTema' ])->name('destroy.tema');

	Route::put('/pqrs/temas/editar/{id}',[PqrController::class, 'updateTema'])->name('update.tema');

	Route::post('/pqrs/temas/crear',[PqrController::class, 'storeTema'])->name('store.tema');

	//rutas ajax
	Route::get('/pqrs/obtener-temas', [ PqrController::class, 'temasPorDepartamento' ])->name('temas.departments');
	Route::get('/pqrs/obtener-empleados', [ PqrController::class, 'employeeByDepartment' ])->name('employees.departments');




});


