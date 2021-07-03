<?php
namespace UrlShortener;

class Config
{
    private string $baseUrl = "http://url_shortening_service/";
    private int $identifierLength = 6;

    public function setBaseUrl(string $baseUrl){
        $this->baseUrl = $baseUrl;
    }

    public function setIdentifierLength(int $identifierLength){
        $this->identifierLength = $identifierLength;
    }

    public function getSiteBaseUrl():string{
        return $this->baseUrl;
    }

    public function getIdentifierLength():int{
        return $this->identifierLength;
    }
}