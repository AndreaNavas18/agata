<?php

Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('users.index'));
});
Breadcrumbs::for('users/crear', function ($trail) {
    $trail->parent('users');
    $trail->push('Crear', route('users.create'));
});
Breadcrumbs::for('users/edit', function ($trail, $data) {
    $trail->parent('users');
    $trail->push('Editar', route('users.edit', $data['id']));
});
Breadcrumbs::for('users/show', function ($trail, $data) {
    $trail->parent('users');
    $trail->push('Ver', route('users.show', $data['id']));
});
Breadcrumbs::for('users/assignment-permissions', function ($trail, $data) {
    $trail->parent('users');
    $trail->push('Asignar permisos', route('users.assignment_permissions', $data['id']));
});

Breadcrumbs::for('mi-perfil', function ($trail, $data) {
    $trail->parent('home');
    $trail->push('Mi perfil', route('my_profile', $data['id']));
});


