<?php

Breadcrumbs::for('tickets', function ($trail) {
    $trail->parent('home');
    $trail->push('Tickets', route('tickets.index'));
});
Breadcrumbs::for('tickets/crear', function ($trail) {
    $trail->parent('tickets');
    $trail->push('Crear', route('tickets.create'));
});
Breadcrumbs::for('tickets/edit', function ($trail, $data) {
    $trail->parent('tickets');
    $trail->push('Editar', route('tickets.edit', $data['id']));
});
Breadcrumbs::for('tickets/show', function ($trail, $data) {
    $trail->parent('tickets');
    $trail->push('Ver', route('tickets.show', $data['id']));
});
Breadcrumbs::for('tickets/manage', function ($trail, $data) {
    $trail->parent('tickets');
    $trail->push('Gestión', route('tickets.manage', $data['id']));
});

