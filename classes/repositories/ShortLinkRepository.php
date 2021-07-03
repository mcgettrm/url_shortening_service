<?php
namespace UrlShortener\Repositories;

class ShortLinkRepository
{
    private array $shortLinksArray;

    public function __construct(){
        $this->loadAll();
    }

    /**
     * Loads all persistent data into memory
     */
    private function loadAll(){
        $this->shortLinksArray = [];
    }

    /**
     * Saves data array to persistant storage
     */
    private function persist(){
        $this->shortLinksArray;
    }

    public function create(string $identifier,string $longUrl,string $shortUrl){
        $this->shortLinksArray[] = [$identifier,$longUrl, $shortUrl];
        $this->persist();
    }

    public function read(string $identifier): ShortLink{
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