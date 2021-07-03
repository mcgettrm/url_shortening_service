<?php
namespace UrlShortener\Repositories;

use UrlShortener\Config;
use UrlShortener\DomainObjects\Models\ShortLink;

class ShortLinkRepository
{
    private array $shortLinksArray;
    private Config $config;

    public function __construct(Config $config){
        $this->config = $config;
        $this->loadAll();
    }

    /**
     * Loads all persistent data into memory
     */
    private function loadAll(){
        $this->shortLinksArray = [];
    }

    /**
     * Saves data array to persistent storage
     */
    private function persist(){
        $this->shortLinksArray;
    }

    public function create(string $identifier,string $longUrl,string $shortUrl){
        $this->shortLinksArray[] = [$identifier,$longUrl, $shortUrl];
        $this->persist();
    }

    /**
     * If found, return instance of domain object, if not return false
     * @param string $identifier
     * @return ShortLink|bool
     */
    public function read(string $identifier){
        $shortLink = new ShortLink();
        return $shortLink;
    }

    public function update(ShortLink $shortLink):bool{
        return true;
    }

    public function delete(ShortLink $shortLink):bool{
        return true;
    }
}