<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Controllers\PesquisaAtendimentoController;

//$app->post('/api/pesquisa_atendimento', [PesquisaAtendimentoController::class, 'create']);

// Rota para buscar todas as pesquisas de atendimento (GET)
//$app->get('/api/pesquisa_atendimento', [PesquisaAtendimentoController::class, 'getAll']);
$app->get('/api/pesquisa-atendimento', 'App\Controllers\PesquisaAtendimentoController:getAll');

// Rota para buscar uma pesquisa de atendimento específica por ID (GET)
$app->get('/api/pesquisa_atendimento/{id}', [PesquisaAtendimentoController::class, 'getById']);