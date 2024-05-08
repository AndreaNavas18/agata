<?php

Breadcrumbs::for('comercial/tariff', function ($trail) {
    $trail->parent('home');
    $trail->push('Comercial (Tarifario) ', route('tariff.index'));
});
Breadcrumbs::for('commercial/tariff/crear', function ($trail) {
    $trail->parent('comercial/tariff');
    $trail->push('Crear', route('tariff.create'));
});
