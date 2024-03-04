<?php

use App\Http\Controllers\Users\UserController;

Route::middleware(['can:users_show'])->namespace('Users')->name('users.')->group(function () {

	Route::get('/users/editar/{id}', [ UserController::class, 'edit' ])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:users_edit');

	Route::put('/users/editar/{id}', [ UserController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:users_edit');

	Route::get('/users/assignment-permissions/{id}', [ UserController::class, 'allocationPermissions' ])->name('assignment_permissions')
		->where('id', '[0-9]+')
		->middleware('can:users_assign_permissions');

	Route::put('/users/assignment-permissions/{id}', [ UserController::class, 'allocationPermissionsUpdate' ])->name('assignment_permissions_update')
		->where('id', '[0-9]+')
		->middleware('can:users_assign_permissions');

});

Route::namespace('Users')->name('users.')->group(function () {

	Route::get('/my-profile/{id}', [ UserController::class, 'profile' ])->name('my_profile')
		->where('id', '[0-9]+');

	Route::put('/my-profile/{id}', [ UserController::class, 'updateProfile' ])->name('update_my_profile')
		->where('id', '[0-9]+');
	
	Route::get('/users', [ UserController::class, 'index' ])->name('index');
	
	Route::get('/users/crear', [ UserController::class, 'create' ])->name('create');

	Route::post('/users/crear',[ UserController::class, 'store' ])->name('store');

	Route::get('/users/ver/{id}', [ UserController::class, 'show' ])->name('show')
		->where('id', '[0-9]+');
	
	Route::delete('/users/eliminar/{id}', [ UserController::class, 'destroy' ])->name('destroy')
	->where('id', '[0-9]+');

	Route::get('/users/buscar', [ UserController::class, 'search' ])->name('search');
});
