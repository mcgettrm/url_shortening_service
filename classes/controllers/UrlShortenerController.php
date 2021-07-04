<?php
namespace UrlShortener\Controllers;

use UrlShortener\DomainObjects\Services\UrlShortenerService;
use UrlShortener\DomainObjects\Services\UrlValidator;
use \Psr\Http\Message\ResponseInterface as Response;

class UrlShortenerController
{
    /**
     * Shortening Service that is persistent and view agnostic
     * @var UrlShortenerService
     */
    private UrlShortenerService $urlShortenerService;

    /**
     * Validation service for handling incoming urls
     * @var UrlValidator
     */
    private UrlValidator $urlValidator;

    /**
     * UrlShortenerController constructor.
     * @param UrlShortenerService $urlShortenerService
     * @param UrlValidator $urlValidator
     */
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
            $encodedUrl = $this->urlShortenerService->encode($urlToEncode);
            $data = array(
                'shortenedUrl' => $encodedUrl
            );

            $statusCode = 200;
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