<?php

Breadcrumbs::for('providers', function ($trail) {
    $trail->parent('home');
    $trail->push('Proveedores', route('providers.index'));
});
Breadcrumbs::for('providers/crear', function ($trail) {
    $trail->parent('providers');
    $trail->push('Crear', route('providers.create'));
});
Breadcrumbs::for('providers/edit', function ($trail, $data) {
    $trail->parent('providers');
    $trail->push('Editar', route('providers.edit', $data['id']));
});
Breadcrumbs::for('providers/show', function ($trail, $data) {
    $trail->parent('providers');
    $trail->push('Ver', route('providers.show', $data['id']));
});
