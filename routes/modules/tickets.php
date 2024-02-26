<?php

use App\Http\Controllers\Tickets\TicketController;
use App\Http\Controllers\Tickets\TicketVisitController;

Route::middleware(['can:tickets_ver'])->namespace('Tickets')->name('tickets.')->group(function () {

	Route::get('/tickets', [ TicketController::class, 'index' ])->name('index')
		->middleware('can:tickets_ver');

	Route::get('/tickets/crear/{serviceId?}', [ TicketController::class, 'create' ])->name('create')
		->middleware('can:tickets_crear');

	Route::post('/tickets/crear',[ TicketController::class, 'store' ])->name('store')
		->middleware('can:tickets_crear');

	Route::get('/tickets/ver/{id}', [ TicketController::class, 'show' ])->name('show')
		->where('id', '[0-9]+')
		->middleware('can:tickets_ver');

	Route::get('/tickets/editar/{customerId}', [ TicketController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:tickets_editar');

	Route::put('/tickets/editar/{id}', [ TicketController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:tickets_editar');

	Route::delete('/tickets/eliminar/{id}', [ TicketController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:tickets_eliminar');

	Route::get('/tickets/buscar', [ TicketController::class, 'search' ])->name('search')
		->middleware('can:tickets_show');

    Route::get('/tickets/gestionar/{id}', [ TicketController::class, 'manage' ])->name('manage')
    ->where('id', '[0-9]+')
    ->middleware('can:tickets_ver');

	//Emails
	Route::post('send-email', [ TicketController::class, 'sendEmail' ])->name('sendEmail');

	//Reabrir tickets
	Route::patch('/tickets/{ticket}/reopen', [ TicketController::class, 'reopen' ])->name('reopen');


    // respuestas nuevas tickets
    Route::post('/tickets/respuesta/crear/{id}',[ TicketController::class, 'replyStore' ])->name('reply.store')
    ->middleware('can:tickets_crear');

    //rutas ajax
	Route::get('/tickets/obtener-empleados-area', [ TicketController::class, 'employeesPositionDepartmant' ])->name('employees.positions.departments')
		->middleware('can:tickets_crear');

    Route::get('/tickets/obtener-clientes-servicios', [ TicketController::class, 'customerServices' ])->name('customers.services')
    ->middleware('can:tickets_crear');

    //visitas tecnicas
    Route::post('/tickets/visitas/crear/{ticketId}',[ TicketVisitController::class, 'store' ])->name('visits.store')
    ->middleware('can:tickets_crear');


});
