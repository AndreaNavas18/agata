<?php
/*
|------------------------------------------------------------------------------
| --------------------------Comercial-----------------------------------------
|------------------------------------------------------------------------------
*/

Breadcrumbs::for('comercial/tariff', function ($trail) {
    $trail->parent('home');
    $trail->push('Comercial (Tarificador) ', route('tariff.index'));
});
Breadcrumbs::for('commercial/tariff/crear', function ($trail) {
    $trail->parent('comercial/tariff');
    $trail->push('Crear', route('tariff.create'));
});

Breadcrumbs::for('commercial/tariff/show', function ($trail, $data) {
    $trail->parent('comercial/tariff');
    $trail->push('Ver', route('tariff.show', $data['id']));
});

Breadcrumbs::for('commercial/tariff/edit', function ($trail, $data) {
    $trail->parent('comercial/tariff');
    $trail->push('Editar', route('tariff.edit', $data['id']));
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


/*
|------------------------------------------------------------------------------
| --------------------------Cotizaciones---------------------------------------
|------------------------------------------------------------------------------
*/


Breadcrumbs::for('quotes', function ($trail) {
    $trail->parent('home');
    $trail->push('Quotes', route('commercial.quotes.index'));
});

Breadcrumbs::for('quotes/crear', function ($trail) {
    $trail->parent('quotes');
    $trail->push('Crear', route('commercial.quotes.create'));
});

Breadcrumbs::for('quotes/manage', function ($trail, $data) {
    $trail->parent('quotes');
    $trail->push('Gestión', route('commercial.quotes.manage', $data['id']));
});

Breadcrumbs::for('quotes/edit', function ($trail, $data) {
    $trail->parent('quotes');
    $trail->push('Editar', route('commercial.quotes.edit', $data['id']));
});



