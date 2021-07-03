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

    }

    public function create(){

    }

    public function read(){

    }

    public function update(){

    }

    public function delete(){

    }
}