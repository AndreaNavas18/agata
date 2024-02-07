<?php


use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});


/*
|-----------------------------------
| Submódulos
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/submodules.php');

/*
|-----------------------------------
| Permisos y Roles
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/permissions.php');


/*
|-----------------------------------
| Usuarios
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/users.php');

/*
|-----------------------------------
| Parámetros
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/parameters.php');


/*
|-----------------------------------
| Clientes
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/customers.php');


/*
|-----------------------------------
| Empleados
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/employees.php');


/*
|-----------------------------------
| Proveedores
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/providers.php');


/*
|-----------------------------------
| Tickets
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/tickets.php');

/*
|-----------------------------------
| servicios
|-----------------------------------
*/
require base_path('routes/modulesBreadcrumbs/services.php');
