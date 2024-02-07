<?php

Breadcrumbs::for('customers', function ($trail) {
    $trail->parent('home');
    $trail->push('Clientes', route('customers.index'));
});
Breadcrumbs::for('customers/crear', function ($trail) {
    $trail->parent('customers');
    $trail->push('Crear', route('customers.create'));
});
Breadcrumbs::for('customers/edit', function ($trail, $data) {
    $trail->parent('customers');
    $trail->push('Editar', route('customers.edit', $data['id']));
});
Breadcrumbs::for('customers/show', function ($trail, $data) {
    $trail->parent('customers');
    $trail->push('Ver', route('customers.show', $data['id']));
});
