<?php

use App\Controllers\ProductController;

use function src\slimConfigurarion;

$app = new \Slim\App(slimConfigurarion());
//=========================================
$app->get('/',ProductController::class .':getProducts');


//=========================================
$app->run();