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
        //If base URL ends with /
        if(substr($this->baseUrl, -1) === "/"){

            //It does, remove it.
            $baseUrl = substr($this->baseUrl,0, -1) ;
            return $baseUrl;
        }
        return $this->baseUrl;
    }

    public function getIdentifierLength():int{
        return $this->identifierLength;
    }
}