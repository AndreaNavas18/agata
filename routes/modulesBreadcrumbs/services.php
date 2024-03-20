<?php

Breadcrumbs::for('services', function ($trail) {
    $trail->parent('home');
    $trail->push('Servicios clientes', route('customers.services.index.all'));
});

Breadcrumbs::for('services/show', function ($trail, $data) {
    $trail->parent('services');
    $trail->push('Ver', route('customers.services.show.service', $data['id']));
});

Breadcrumbs::for('services/show/config', function ($trail, $data) {
    $trail->parent('services');
    $trail->push('Ver', route('customers.services.show.config', $data['id']));
});
