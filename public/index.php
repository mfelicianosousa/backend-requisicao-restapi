<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$configuration = new \Slim\Container($configuration);

# middlaware 01 de autenticação

$mid01 = function(Request $request, Response $response, $next): Response {
    # Poderia fazer um código aqui para validar os dados    que o usuário envio para ver se realmente ele pode acessar a API.
    $response->getBody()->write("Por dentro do middleware-01 <br>");
    
    $next($request, $response);
    
    $response->getBody()->write("<br>Por dentro do middleware-02");
    
    return $response;
};

$app = new \Slim\App($configuration);

$app->get('/',function(Request $request, Response $response, array $args) {
    
    return $response->getBody()->write('Bem vindo ao PHPSlim!');

})->add( $mid01);


$app->group('/produto', function() use($app) {
    $app->get('[/{nome}]',function(Request $request, Response $response, array $args): Response {
        $limit = $request->getQueryParams()['limit'] ?? 10;
        $nome = $args['nome'] ?? 'mouse';
    
        $response->getBody()->write("{$nome} {$limit} Produtos do Banco de Dados.");
        return $response;
    
    });

   

})->add( $mid01 );


$app->post('/produto',function(Request $request, Response $response, array $args): Response {
  
    $data = $request->getParsedBody();

    $nome = $data['nome'] ?? ''; # Se não tiver nada deixar uma string vazia
    $quantidade = $data['quantidade'] ?? 0;
    $valor = $data['valor'] ?? 0.00;

    //print_r($data); die;

    $response->getBody()->write("post-> Produto {$nome} quantidade: {$quantidade} Preço: {$valor}");
    return $response;

});

$app->put('/produto',function(Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();

    $nome = $data['nome'] ?? ''; # Se não tiver nada deixar uma string vazia
    $quantidade = $data['quantidade'] ?? 0;
    $valor = $data['valor'] ?? 0.00;

    //print_r($data); die;

    return $response->getBody()->write("put-> Produto {$nome} quantidade: {$quantidade} Preço: {$valor}");

});

$app->delete('/produto',function(Request $request, Response $response, array $args) {
  
    $data = $request->getParsedBody();

    $nome = $data['nome'] ?? ''; # Se não tiver nada deixar uma string vazia
    $quantidade = $data['quantidade'] ?? 0;
    $valor = $data['valor'] ?? 0.00;

    //print_r($data); die;

    return $response->getBody()->write("delete->Produto {$nome} quantidade: {$quantidade} Preço: {$valor}");

});


$app->run();