<?php
namespace UrlShortener\Controllers;

use UrlShortener\DomainObjects\Services\UrlShortenerService;
use UrlShortener\DomainObjects\Services\UrlValidator;
use \Psr\Http\Message\ResponseInterface as Response;

class UrlShortenerController
{
    private UrlShortenerService $urlShortenerService;
    private UrlValidator $urlValidator;

    public function __construct(
        UrlShortenerService $urlShortenerService,
        UrlValidator $urlValidator
    ){
        $this->urlShortenerService = $urlShortenerService;
        $this->urlValidator = $urlValidator;
    }

    /**
     * @param string $urlToEncode
     * @param Response $response
     * @return Response
     */
    public function encode(string $urlToEncode, Response $response):Response{

        if($this->urlValidator->isValidLongUrl($urlToEncode)){
            $data = array(
                'shortenedUrl' => $this->urlShortenerService->encode($urlToEncode)
            );

            $statusCode = 201;
        } else {
            $data = [];
            $statusCode = 400;
        }

        return $response->withJson($data, $statusCode);
    }

    /**
     * @param string $urlToDecode
     * @param Response $response
     * @return Response
     */
    public function decode(string $urlToDecode, Response $response):Response{

        if($this->urlValidator->isValidShortUrl($urlToDecode)){
            $decodedUrl = $this->urlShortenerService->decode($urlToDecode);

            if(strlen($decodedUrl)){
                $data = array('decodedUrL'=>$decodedUrl);
                $statusCode = 200;
            } else {
                $data = [];
                $statusCode = 404;
            }

        } else {
            $data = [];
            $statusCode = 400;
        }

        return $response->withJson($data, $statusCode);

    }
}