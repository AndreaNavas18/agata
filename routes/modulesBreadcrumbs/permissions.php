<?php

// Permisos
Breadcrumbs::for('permissions', function ($trail) {
    $trail->parent('home');
    $trail->push('Permisos', route('permissions.index'));
});


// Roles
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
});
Breadcrumbs::for('roles/edit', function ($trail, $data) {
    $trail->parent('roles');
    $trail->push('Editar', route('roles.edit', $data['id']));
});
