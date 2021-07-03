<?php
namespace UrlShortener;

class Config
{
    /**
     * The domain name of the installation
     * @var string
     */
    private string $baseUrl = "http://url_shortening_service/";

    /**
     * The length of the unique identifiers that will be returned on the end of the shortlinks
     * @var int
     */
    private int $identifierLength = 6;

    /**
     * A boolean flag that dictates how the software will respond to duplicate Long URLs being submitted
     * True: Return a new unique identifier
     * False: Return the previously set identifier for this URL
     * @var bool
     */
    private bool $allowDuplicateLongUrls = false;

    public function setBaseUrl(string $baseUrl){
        $this->baseUrl = $baseUrl;
    }

    public function setIdentifierLength(int $identifierLength){
        $this->identifierLength = $identifierLength;
    }

    public function setAllowDuplicateLongURLs(bool $boolean){
        $this->allowDuplicateLongUrls = $boolean;
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

    public function getAllowDuplicateLongUrls():bool{
        return $this->allowDuplicateLongUrls;
    }
}