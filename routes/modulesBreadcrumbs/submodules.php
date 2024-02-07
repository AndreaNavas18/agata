<?php

Breadcrumbs::for('submodules', function ($trail) {
    $trail->parent('home');
    $trail->push('Submodulos', route('submodules.index'));
});

