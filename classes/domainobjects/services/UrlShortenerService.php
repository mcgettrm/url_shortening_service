<?php
namespace UrlShortener\DomainObjects\Services;

use UrlShortener\Config;
use UrlShortener\Repositories\ShortLinkRepository;

class UrlShortenerService
{
    private ShortLinkRepository $shortLinkRepository;
    private Config $config;

    public function __construct(
        ShortLinkRepository $shortLinkRepository,
        Config $config
    ){
        $this->config = $config;
        $this->shortLinkRepository = $shortLinkRepository;
    }

    /**
     * Takes an unencoded, long URL and returns an encoded, short URL that is compatible with the decode method
     * of this class.
     * @param string $urlToEncode
     * @return string
     */
    public function encode(string $urlToEncode):string{
        $encodedUrl = "test";
        return $encodedUrl;
    }

    /**
     * Takes a short URL encoded by the Encode endpoint and decodes it according to busines logic, returning the original long URL.
     * @param string $urlToDecode
     * @return string
     */
    public function decode(string $urlToDecode):string{
        $decodedUrl = "test";
        return $decodedUrl;
    }
}