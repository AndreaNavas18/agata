<?php

use App\Http\Controllers\Tickets\TicketController;
use App\Http\Controllers\Tickets\TicketVisitController;
use App\Http\Controllers\NotificationController;

Route::namespace('Tickets')->name('tickets.')->group(function () {

	Route::get('/tickets', [ TicketController::class, 'index' ])->name('index');

	Route::get('/tickets/crear/{serviceId?}', [ TicketController::class, 'create' ])->name('create')
		->middleware('can:tickets.create');

	Route::post('/tickets/crear',[ TicketController::class, 'store' ])->name('store')
		->middleware('can:tickets.create');

	Route::get('/tickets/ver/{id}', [ TicketController::class, 'show' ])->name('show')
		->where('id', '[0-9]+')
		->middleware('can:tickets.show');

	Route::get('/tickets/editar/{customerId}', [ TicketController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:tickets.edit');

	Route::put('/tickets/editar/{id}', [ TicketController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:tickets.edit');

	Route::delete('/tickets/eliminar/{id}', [ TicketController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:tickets.destroy');

	Route::get('/tickets/buscar', [ TicketController::class, 'search' ])->name('search')
		->middleware('can:tickets.search');

    Route::get('/tickets/gestionar/{id}', [ TicketController::class, 'manage' ])->name('manage')
    ->where('id', '[0-9]+')
    ->middleware('can:tickets.manage');

	//Emails
	Route::post('send-email', [ TicketController::class, 'sendEmail' ])->name('sendEmail');

	//Reabrir tickets
	Route::patch('/tickets/{ticket}/reopen', [ TicketController::class, 'reopen' ])->name('reopen');

	//Asignar agente
	Route::patch('/tickets/{ticket}/asignarAgente', [ TicketController::class, 'asignarAgente' ])->name('asignarAgente');

	//Cambio de prioridad 

	Route::patch('/tickets/{ticket}/cambiarPrioridad', [ TicketController::class, 'cambiarPrioridad' ])->name('cambiarPrioridad');

    // respuestas nuevas tickets
    Route::post('/tickets/respuesta/crear/{id}',[ TicketController::class, 'replyStore' ])->name('reply.store')
    ->middleware('can:tickets.index');

    //rutas ajax
	Route::get('/tickets/obtener-empleados-area', [ TicketController::class, 'employeesPositionDepartmant' ])->name('employees.positions.departments')
		->middleware('can:tickets.index');

    Route::get('/tickets/obtener-clientes-servicios', [ TicketController::class, 'customerServices' ])->name('customers.services')
    ->middleware('can:tickets.index');
	
	Route::get('/tickets/obtener-clientes-servicios-proyecto', [ TicketController::class, 'customerServicesProject' ])->name('customers.servicesProject')
    ->middleware('can:tickets.index');

    //visitas tecnicas
    Route::post('/tickets/visitas/crear/{ticketId}',[ TicketVisitController::class, 'store' ])->name('visits.store')
    ->middleware('can:tickets.create');

	// Route::get('get-employee-files/{employeeId}', [ TicketController::class, 'getEmployeeFiles' ])->name('getEmployeeFiles');

	Route::get('get-employee-files', [TicketController::class, 'getEmployeeFiles'])->name('getEmployeeFiles');



});

Route::patch('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
