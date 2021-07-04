<?php
namespace UrlShortener\DomainObjects\Models;

/**
 * This class represents the concept of a shortlink within our application
 * Class ShortLink
 * @package UrlShortener\DomainObjects\Models
 */
class ShortLink
{
    private string $identifier = "";
    private string $shortUrl = "";
    private string $longUrl = "";

    public function setLongUrl(string $longUrl){
        $this->longUrl = $longUrl;
    }

    public function setShortUrl(string $shortUrl){
        $this->shortUrl = $shortUrl;
    }

    public function setIdentifier(string $identifier){
        $this->identifier = $identifier;
    }

    public function getLongUrl():string{
        return $this->longUrl;
    }

    public function getShortUrl():string{
        return $this->shortUrl;
    }

    public function getIdentifier():string{
        return $this->identifier;
    }
}