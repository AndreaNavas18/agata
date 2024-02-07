<?php

use App\Http\Controllers\Employees\EmployeeController;

Route::middleware(['can:empleados_show'])->namespace('Employees')->name('employees.')->group(function () {

	Route::get('/empleados', [ EmployeeController::class, 'index' ])->name('index')
		->middleware('can:empleados_show');

	Route::get('/empleados/crear', [ EmployeeController::class, 'create' ])->name('create')
		->middleware('can:empleados_create');

	Route::post('/empleados/crear',[ EmployeeController::class, 'store' ])->name('store')
		->middleware('can:empleados_create');

	Route::get('/empleados/ver/{id}', [ EmployeeController::class, 'show' ])->name('show')
		->where('id', '[0-9]+')
		->middleware('can:empleados_show');

	Route::get('/empleados/editar/{customerId}', [ EmployeeController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:empleados_edit');

	Route::put('/empleados/editar/{id}', [ EmployeeController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:empleados_edit');

	Route::delete('/empleados/eliminar/{id}', [ EmployeeController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:empleados_destroy');

	Route::get('/empleados/buscar', [ EmployeeController::class, 'search' ])->name('search')
		->middleware('can:empleados_show');
});


