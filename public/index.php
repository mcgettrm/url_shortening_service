<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UrlShortener\Controllers\UrlShortenerController;
use UrlShortener\DomainObjects\Services\UrlShortenerService;
use UrlShortener\DomainObjects\Services\UrlValidator;
use UrlShortener\Repositories\ShortLinkRepository;

require '../vendor/autoload.php';

$container = new \Slim\Container;
$app = new \Slim\App($container);

//Register services
$container = $app->getContainer();

//Controllers
$container[UrlShortenerController::class] = function($container){
    return new UrlShortenerController(
        $container[UrlShortenerService::class],
        $container[UrlValidator::class]
    );
};


//Services
$container[UrlShortenerService::class] = function($container){
    $shortLinkRepository = $container[ShortLinkRepository::class];
    return new UrlShortenerService(
        $shortLinkRepository
    );
};

$container[UrlValidator::class] = function($container){
    return new UrlValidator();
};

//Repositories
$container[ShortLinkRepository::class] = function($container){
    return new ShortLinkRepository();
};


//Register routes
$app->post('/api/shortener/encode',function(Request $request, Response $response, array $args){

    //Get UrlShortenerController
    /** @var UrlShortenerController $urlShortenerController */
    $urlShortenerController = $this->get(UrlShortenerController::class);
    $urlToEncode = $args['urlToEncode'] ?? "";

    return $urlShortenerController->encode($urlToEncode, $response);
});

$app->get('/api/shortener/decode',function(Request $request, Response $response, array $args){

    //Get UrlShortenerController
    /** @var UrlShortenerController $urlShortenerController */
    $urlShortenerController = $this->get(UrlShortenerController::class);

    $urlToDecode = $args['urlToEncode'] ?? "";

    return $urlShortenerController->decode($urlToDecode, $response);
});
$app->run();
