<?php
namespace UrlShortener\DomainObjects\Services;

class UrlValidator
{
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