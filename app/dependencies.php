<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$container = $app->getContainer();

// Configuração do Eloquent ORM
$capsule = new Capsule;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Adiciona o Capsule ao container
$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};
