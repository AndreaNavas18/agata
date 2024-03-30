<?php

use App\Http\Controllers\Employees\EmployeeController;

Route::middleware(['can:employees.index'])->namespace('Employees')->name('employees.')->group(function () {

	Route::get('/empleados', [ EmployeeController::class, 'index' ])->name('index')
		->middleware('can:employees.index');

	Route::get('/empleados/crear', [ EmployeeController::class, 'create' ])->name('create')
		->middleware('can:employees.create');

	Route::post('/empleados/crear',[ EmployeeController::class, 'store' ])->name('store')
		->middleware('can:employees.create');

	Route::get('/empleados/ver/{id}', [ EmployeeController::class, 'show' ])->name('show')
		->where('id', '[0-9]+')
		->middleware('can:employees.show');

	Route::get('/empleados/editar/{customerId}', [ EmployeeController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:employees.edit');

	Route::put('/empleados/editar/{id}', [ EmployeeController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:employees.edit');

	Route::delete('/empleados/eliminar/{id}', [ EmployeeController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:employees.destroy');

	Route::get('/empleados/buscar', [ EmployeeController::class, 'search' ])->name('search')
		->middleware('can:employees.search');

	Route::get('/empleados/eliminar/archivo/{id}', [ EmployeeController::class, 'deleteFile' ])->name('delete.file')
		->where('id', '[0-9]+')
		->middleware('can:employees.destroy');

	Route::get('/empleados/descargar/archivo/{id}', [ EmployeeController::class, 'downloadFile' ])->name('download.file')
		->where('id', '[0-9]+')
		->middleware('can:employees.show');
});


