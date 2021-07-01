<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

//Register services
$container = $app->getContainer();

//UrlShortener Service
$container[UrlShortenerService::class] = function($container){
    return new UrlShortenerService();
};

//Url Validator
$container[UrlValidator::class] = function($container){
    return new UrlValidator();
};

//Repository
$container[ShortLinkRepository::class] = function($container){
    return new ShortLinkRepository();
};


//Register routes
$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello world");

    return $response;
});
$app->run();
