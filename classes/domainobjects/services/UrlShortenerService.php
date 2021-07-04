<?php
namespace UrlShortener\DomainObjects\Services;

use UrlShortener\Config;
use UrlShortener\DomainObjects\Models\ShortLink;
use UrlShortener\Repositories\ShortLinkRepository;

class UrlShortenerService
{
    /**
     * Adapter for persistent storage of shortlink objects
     * @var ShortLinkRepository
     */
    private ShortLinkRepository $shortLinkRepository;

    /**
     * Application's configuration object
     * @var Config
     */
    private Config $config;

    /**
     * UrlShortenerService constructor.
     * @param Config $config
     * @param ShortLinkRepository $shortLinkRepository
     */
    public function __construct(
        Config $config,
        ShortLinkRepository $shortLinkRepository
    ){
        $this->config = $config;
        $this->shortLinkRepository = $shortLinkRepository;
    }

    /**
     * Takes the unique identifier from a URL
     * @param $encodedUrl
     * @return false|string
     */
    private function getIdentifierFromEncodedUrl($encodedUrl){
        $identifier = substr($encodedUrl, strrpos($encodedUrl, '/') + 1);
        return $identifier;
    }

    /**
     * @param string $inputString
     * @param int $offset
     * @return string
     */
    private function generateIdentifierFromString(string $inputString, int $offset):string
    {
        $md5Encoded = md5($inputString);
        $base64Md5Encoded = base64_encode($md5Encoded);
        $urlSafe = str_replace(['/','+','='],'',$base64Md5Encoded);

        //Outside chance that we have had so many collisions that we run out of string. Time to admit there's an error.
        if(($offset + $this->config->getIdentifierLength()) > strlen($urlSafe)){
            return false;
        }
        $identifier = substr($base64Md5Encoded, $offset,$this->config->getIdentifierLength());
        return $identifier;
    }

    /**
     * Takes an unencoded, long URL and returns an encoded, short URL that is compatible with the decode method
     * of this class.
     * @param string $urlToEncode
     * @param int $offset
     * @return string
     */
    public function encode(string $urlToEncode, int $offset = 0):string{

        $identifier = $this->generateIdentifierFromString($urlToEncode, $offset);
        if($identifier === false){
            return false;
        }
        $encodedUrl = $this->config->getSiteBaseUrl() . '/' . $identifier ;

        $shortLinkObj = $this->shortLinkRepository->read($identifier);


        //Identifier doesn't exist yet, create it.
        if($shortLinkObj === false){
            //Identifier is unique, go ahead
            $this->shortLinkRepository->create($identifier,$urlToEncode,$encodedUrl);
            return $encodedUrl;
        } else {
            return $this->handleDuplicateIdentifier($urlToEncode, $shortLinkObj, $offset);
        }
    }

    /**
     * @param string $urlToEncode
     * @param ShortLink $shortLink
     * @param int $offset
     * @param $identifier
     * @param $encodedUrl
     * @return string
     */
    private function handleDuplicateIdentifier(
        string $urlToEncode,
        ShortLink $shortLink,
        int $offset
    ){

        //We have a duplicate
        $originalUrlIsSame = $shortLink->getLongUrl() === $urlToEncode;

        if($originalUrlIsSame){
            //We a true duplicate
            if($this->config->getAllowDuplicateLongUrls()){

                return $this->encode($urlToEncode, ++$offset);
            } else {

                return $shortLink->getShortUrl();
            }

        } else {
            //Collision
            return $this->encode($urlToEncode, ++$offset);
        }

    }

    /**
     * Takes a short URL encoded by the Encode endpoint and decodes it according to busines logic, returning the original long URL.
     * @param string $urlToDecode
     * @return string
     */
    public function decode(string $urlToDecode):string{
        $identifier = $this->getIdentifierFromEncodedUrl($urlToDecode);
        $shortLink = $this->shortLinkRepository->read($identifier);
        if($shortLink === false){
            return false;
        } else {
            return $shortLink->getLongUrl();
        }
    }
}