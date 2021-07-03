<?php
namespace UrlShortener\DomainObjects\Services;

use UrlShortener\Config;

class UrlValidator
{
    private Config $config;
    public function __construct(Config $config){
        $this->config = $config;
    }
    /**
     * Checks that a Long URL is valid for use by this application
     * @param string $longUrl
     * @return bool
     */
    public function isValidLongUrl(string $longUrl):bool{
        return true;
    }

    /**
     * Checks that a Short URL is valid for use by this application
     * @param string $shortUrl
     * @return bool
     */
    public function isValidShortUrl(string $shortUrl):bool{
        return true;
    }
}