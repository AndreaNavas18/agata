<?php
/*
|------------------------------------------------------------------------------
| --------------------------Comercial-----------------------------------------
|------------------------------------------------------------------------------
*/

Breadcrumbs::for('comercial/tariff', function ($trail) {
    $trail->parent('home');
    $trail->push('Comercial (Tarifario) ', route('tariff.index'));
});
Breadcrumbs::for('commercial/tariff/crear', function ($trail) {
    $trail->parent('comercial/tariff');
    $trail->push('Crear', route('tariff.create'));
});


/*
|------------------------------------------------------------------------------
| --------------------------Tarificador-----------------------------------------
|------------------------------------------------------------------------------
*/

Breadcrumbs::for('tariff/params', function ($trail) {
    $trail->parent('home');
    $trail->push('Tarificador (Parametros) ', route('tariff.parameters'));
});

Breadcrumbs::for('tariff/params/typeService', function ($trail) {
    $trail->parent('tariff/params');
    $trail->push('Tipo de servicios ', route('tariff.params.service.index'));
});

Breadcrumbs::for('tariff/params/bandwidth', function ($trail) {
    $trail->parent('tariff/params');
    $trail->push('Banda Ancha ', route('tariff.params.bandwidth.index'));
});



