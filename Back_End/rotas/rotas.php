<?php

use APP\Controllers\TarefaController;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Middleware para tratar JSON
$app->addBodyParsingMiddleware();

// Rotas usando o formato correto (array com classe e método)
$app->get('/tarefas', [TarefaController::class, 'listar']);
$app->post('/tarefas', [TarefaController::class, 'inserir']);
$app->put('/tarefas/{id:[0-9]+}', [TarefaController::class, 'alterar']);
$app->delete('/tarefas/{id:[0-9]+}', [TarefaController::class, 'excluir']);
$app->patch('/tarefas/{id:[0-9]+}/concluir', [TarefaController::class, 'concluir']);
$app->options('/{routes:.+}', function ($request, $response) {
    return $response;
});

require __DIR__ . '/middleware.php';
$app->run();
