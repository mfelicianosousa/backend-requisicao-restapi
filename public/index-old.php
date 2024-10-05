<?php
use Slim\App;
use Slim\Container;

require __DIR__ . '/../vendor/autoload.php';

// Configurações do container
$configuration = [
    'settings' => [
        'displayErrorDetails' => true, // Mostrar detalhes de erro no ambiente de desenvolvimento
        'db' => [
            'host' => 'localhost',
            'dbname' => 'ms_gestor_dev',
            'user' => 'root',
            'pass' => '',
        ]
    ]
];

$container = new Container($configuration);

// Adicionando a configuração de PDO no container
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// Criando a aplicação Slim com o container
$app = new App($container);

// Carregar rotas
require __DIR__ . '/../src/routes.php';

$app->run();
