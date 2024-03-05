<?php

Breadcrumbs::for('proyectos', function ($trail) {
    $trail->parent('home');
    $trail->push('Proyectos clientes', route('customers.proyectos.index.all'));
});

Breadcrumbs::for('proyectos/show', function ($trail, $data) {
    $trail->parent('proyectos');
    $trail->push('Ver', route('customers.proyectos.show.proyecto', $data['id']));
});

Breadcrumbs::for('proyectos/edit', function ($trail, $data) {
    $trail->parent('proyectos');
    $trail->push('Ver', route('customers.proyectos.edit', $data['id']));
});

