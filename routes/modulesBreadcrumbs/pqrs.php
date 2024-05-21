<?php

Breadcrumbs::for('pqrs', function ($trail) {
    $trail->parent('home');
    $trail->push('Pqrs internos', route('pqrs.index'));
});

Breadcrumbs::for('pqrs/show', function ($trail, $data) {
    $trail->parent('pqrs');
    $trail->push('Ver', route('pqrs.show', $data['id']));
});

Breadcrumbs::for('pqrs/crear', function ($trail) {
    $trail->parent('pqrs');
    $trail->push('Crear', route('pqrs.create'));
});

