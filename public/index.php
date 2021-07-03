<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use UrlShortener\DomainObjects\Services\UrlShortenerService;
use UrlShortener\DomainObjects\Services\UrlValidator;
use UrlShortener\Repositories\ShortLinkRepository;

require '../vendor/autoload.php';

$container = new \Slim\Container;
$app = new \Slim\App($container);

//Register services
$container = $app->getContainer();

//UrlShortener Service
$container[UrlShortenerService::class] = function($container){
    $shortLinkRepository = $container[ShortLinkRepository::class];
    return new UrlShortenerService(
        $shortLinkRepository
    );
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

$app->post('/api/shortener/encode',function(Request $request, Response $response, array $args){

    //TODO::Move to Controller
    $urlToEncode = $args['urlToEncode'];

    //Validate
    /** @var UrlValidator $urlValidator */
    $urlValidator = $this->get(UrlValidator::class);
    $urlValidator->

    //Encode
    /** @var UrlShortenerService $urlShortenerService */
    $urlShortenerService = $this->get(UrlShortenerService::class);
    $data = array(
        'shortenedUrl' => $urlShortenerService->encode($urlToEncode)
    );
    $jsonResponse = $response->withJson($data, 201);
    return $jsonResponse;
});

$app->post('/api/shortener/decode',function(Request $request, Response $response, array $args){

    /** @var UrlShortenerService $urlShortenerService */
    $urlShortenerService = $this->get(UrlShortenerService::class);

    /** @var UrlValidator $urlValidator */
    $urlValidator = $this->get(UrlValidator::class);

    $data = array('name' => 'Bob', 'age' => 40);
    $jsonResponse = $response->withJson($data, 200);
    return $jsonResponse;
});
$app->run();
