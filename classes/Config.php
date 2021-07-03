<?php
namespace UrlShortener;

class Config
{
    private string $baseUrl = "http://url_shortening_service/";
    private int $identifierLength = 6;

    public function getSiteBaseUrl():string{
        return $this->baseUrl;
    }

    public function getIdentifierLength():int{
        return $this->identifierLength;
    }
}