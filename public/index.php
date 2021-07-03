<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UrlShortener\Config;
use UrlShortener\Controllers\UrlShortenerController;
use UrlShortener\DomainObjects\Services\UrlShortenerService;
use UrlShortener\DomainObjects\Services\UrlValidator;
use UrlShortener\Repositories\ShortLinkRepository;

require '../vendor/autoload.php';

$container = new \Slim\Container;
$app = new \Slim\App($container);

//Register services
$container = $app->getContainer();

//Config
$container[Config::class] = function($container){
    return new Config();
};

//Controllers
$container[UrlShortenerController::class] = function($container){
    return new UrlShortenerController(
        $container[UrlShortenerService::class],
        $container[UrlValidator::class]
    );
};


//Services
$container[UrlShortenerService::class] = function($container){
    $config = $container[Config::class];
    $shortLinkRepository = $container[ShortLinkRepository::class];
    return new UrlShortenerService(
        $config,
        $shortLinkRepository
    );
};

$container[UrlValidator::class] = function($container){
    $config = $container[Config::class];
    return new UrlValidator(
        $config
    );
};

//Repositories
$container[ShortLinkRepository::class] = function($container){
    $config = $container[Config::class];
    return new ShortLinkRepository(
        $config
    );
};


//Register routes
$app->post('/api/shortener/encode',function(Request $request, Response $response, array $args){

    //Get UrlShortenerController
    /** @var UrlShortenerController $urlShortenerController */
    $urlShortenerController = $this->get(UrlShortenerController::class);
    $body = $request->getParsedBody();
    $urlToEncode = $body['urlToEncode'] ?? "";

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
