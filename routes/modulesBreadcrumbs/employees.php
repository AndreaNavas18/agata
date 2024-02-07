<?php

Breadcrumbs::for('employees', function ($trail) {
    $trail->parent('home');
    $trail->push('Empleados', route('employees.index'));
});
Breadcrumbs::for('employees/create', function ($trail) {
    $trail->parent('employees');
    $trail->push('Crear', route('employees.create'));
});
Breadcrumbs::for('employees/edit', function ($trail, $data) {
    $trail->parent('employees');
    $trail->push('Editar', route('employees.edit', $data['id']));
});
Breadcrumbs::for('employees/show', function ($trail, $data) {
    $trail->parent('employees');
    $trail->push('Ver', route('employees.show', $data['id']));
});
