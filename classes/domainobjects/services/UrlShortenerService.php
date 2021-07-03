<?php
namespace UrlShortener\DomainObjects\Services;

use UrlShortener\Config;
use UrlShortener\DomainObjects\Models\ShortLink;
use UrlShortener\Repositories\ShortLinkRepository;

class UrlShortenerService
{
    private ShortLinkRepository $shortLinkRepository;
    private Config $config;

    public function __construct(
        Config $config,
        ShortLinkRepository $shortLinkRepository
    ){
        $this->config = $config;
        $this->shortLinkRepository = $shortLinkRepository;
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

        if(($offset + $this->config->getIdentifierLength()) > strlen($base64Md5Encoded)){
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
        $decodedUrl = "test";
        return $decodedUrl;
    }
}