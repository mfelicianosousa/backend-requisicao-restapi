<?php

namespace src;

function slimConfigurarion(): \Slim\Container
{

    $configuration = [
        'setting' => [
            'displayErrorDetails' => getenv('DISPLAY_ERRORS_DETAILS'),
        ]
    ];
    return new \Slim\Container($configuration);
}


