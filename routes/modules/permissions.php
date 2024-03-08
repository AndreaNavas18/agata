<?php

/*
|-----------------------------------
| Permissions
|-----------------------------------
*/

use App\Http\Controllers\Permissions\PermissionController;
use App\Http\Controllers\Roles\RoleController;

Route::middleware(['can:permissions.index'])->namespace('Permissions')->name('permissions.')->group(function () {

	Route::get('/permisos', [ PermissionController::class, 'index' ])->name('index')
		->middleware('can:permissions.index');

	Route::post('/permisos/crear', [ PermissionController::class, 'store' ])->name('store')
		->middleware('can:permissions.create');

	Route::put('/permisos/editar/{id}', [ PermissionController::class, 'update' ])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:permissions.edit');

	Route::delete('/permisos/eliminar/{id}', [ PermissionController::class, 'destroy' ])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:permissions.destroy');

	Route::get('/permisos/search', [ PermissionController::class, 'search' ])->name('search')
		->middleware('can:permissions.search');
});

/*
|-----------------------------------
| Roles
|-----------------------------------
*/
Route::middleware(['can:roles.index'])->namespace('Roles')->name('roles.')->group(function () {

	Route::get('/roles', [ RoleController::class, 'index'])->name('index')
		->middleware('can:roles.index');

	Route::post('/roles/crear', [ RoleController::class, 'store'])->name('store')
		->middleware('can:roles.create');

	Route::get('/roles/editar/{id}', [ RoleController::class, 'edit'])->name('edit')
		->where('id', '[0-9]+')
		->middleware('can:roles.edit');

	Route::put('/roles/editar/{id}', [ RoleController::class, 'update'])->name('update')
		->where('id', '[0-9]+')
		->middleware('can:roles.edit');

	Route::delete('/roles/eliminar/{id}', [ RoleController::class, 'destroy'])->name('destroy')
		->where('id', '[0-9]+')
		->middleware('can:roles.destroy');

	Route::get('/roles/search', [ RoleController::class, 'search'])->name('search')
		->middleware('can:roles.search');

});
