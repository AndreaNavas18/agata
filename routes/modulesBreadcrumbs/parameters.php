<?php


use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/*
|------------------------------------------------------------------------------
| --------------------------employees-----------------------------------------
|------------------------------------------------------------------------------
*/

Breadcrumbs::for('parameters/employees', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Parámetros ( Empleados )', route('params.employees'));
});

/*
|-----------------------------------
| ARL
|-----------------------------------
*/

Breadcrumbs::for('parameters/employees/arl', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/employees');
    $trail->push('ARL', route('params.employees.arl'));
});

/*
|-----------------------------------
|EPS
|-----------------------------------
*/

Breadcrumbs::for('parameters/employees/eps', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/employees');
    $trail->push('EPS', route('params.employees.eps'));
});


/*
|-----------------------------------
|cargos
|-----------------------------------
*/

Breadcrumbs::for('parameters/employees/positions', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/employees');
    $trail->push('Cargos', route('params.employees.positions'));
});


/*
|-----------------------------------
|cesantias
|-----------------------------------
*/
Breadcrumbs::for('parameters/employees/severance', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/employees');
    $trail->push('Cesantias', route('params.employees.severance'));
});



/*
|-----------------------------------
|departments
|-----------------------------------
*/
Breadcrumbs::for('parameters/employees/departments', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/employees');
    $trail->push('Departamentos', route('params.employees.departments'));
});

/*
|-----------------------------------
|pensiones
|-----------------------------------
*/
Breadcrumbs::for('parameters/employees/pensions', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/employees');
    $trail->push('Departamentos', route('params.employees.pensions'));
});


/*
|-----------------------------------
|Tipos documentos
|-----------------------------------
*/
Breadcrumbs::for('parameters/employees/types_documents', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/employees');
    $trail->push('Tipos documentos', route('params.employees.types_documents'));
});


/*
|------------------------------------------------------------------------------
| --------------------------General-----------------------------------------
|------------------------------------------------------------------------------
*/

Breadcrumbs::for('parameters/general', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Parámetros ( General )', route('params.general'));
});


/*
|-----------------------------------
|   paises
|-----------------------------------
*/
Breadcrumbs::for('parameters/general/countries', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/general');
    $trail->push('Paises', route('params.general.countries'));
});


/*
|-----------------------------------
|   ciudades
|-----------------------------------
*/
Breadcrumbs::for('parameters/general/cities', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/general');
    $trail->push('Ciudades', route('params.general.cities'));
});


/*
|-----------------------------------
|   departamentos
|-----------------------------------
*/
Breadcrumbs::for('parameters/general/departments', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/general');
    $trail->push('Departamentos', route('params.general.departments'));
});

/*
|-----------------------------------
|   servicios
|-----------------------------------
*/
Breadcrumbs::for('parameters/general/services', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/general');
    $trail->push('Servicios Stratecsa', route('params.general.services'));
});


/*
|-----------------------------------
|Tipos contactos
|-----------------------------------
*/
Breadcrumbs::for('parameters/general/types_contact', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/general');
    $trail->push('Tipos contactos', route('params.general.types_contact'));
});

/*
|-----------------------------------
|Tipos documentos
|-----------------------------------
*/
Breadcrumbs::for('parameters/general/types_documents', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/general');
    $trail->push('Tipos documentos', route('params.general.types_documents'));
});

/*
|-----------------------------------
|Motivos de solicitud
|-----------------------------------
*/
Breadcrumbs::for('parameters/general/types_priorities', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/general');
    $trail->push('Tipos prioridades', route('params.general.types_priorities'));
});

/*
|-----------------------------------
|Motivos de solicitud
|-----------------------------------
*/
Breadcrumbs::for('parameters/general/proyectos', function (BreadcrumbTrail $trail) {
    $trail->parent('parameters/general');
    $trail->push('Proyectos', route('params.general.proyectos'));
});


