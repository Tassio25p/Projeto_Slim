<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// Middleware CORS
$app->add(function (Request $request, Response $response, $next) {
    $response = $next->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*') // libera tudo (ajuste depois)
        ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
});
