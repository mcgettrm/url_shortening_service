<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use UrlShortener\Config;

/**
 * Class EncodeTest
 *
 * Should cover the following scenarios:
 * - Should generate string with a CONFIG_IDENTIFIER_LENGTH IDENTIFIER at the end.
 * - Should confirm that LONG_URL is a valid URL (or return status code 400).
 * - Identifier should be unique.
 * - Should return a string CONFIG_DOMAIN_NAME at the beginning to the caller. [DONE]
 * - IDENTIFIER should be a valid HTTP URL.
 * - Encoded URL should have only one /
 * - Should be saved in persistence
 * - Does not save in persistence if the identifier already exists (identifier is unique)
 */
class EncodeTest extends TestCase
{
    private $genericBaseUrl = "my_base_url.co.uk";

    //Using an array here so that we can easily add new example urls
    private $testUrls = [
        'www.mcgettrixelectrix.co.uk/my_ad_campaign'
    ];

    private function getGenericUrlShorteningService(Config $config){
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);

        $shorteningService = new \UrlShortener\DomainObjects\Services\UrlShortenerService(
            $config,
            $shortLinkRepository
        );

        return $shorteningService;
    }

    private function getConfig($baseServerUrl = null, $identifierLength = null){
        $config = new Config();
        if($identifierLength){
            $config->setIdentifierLength($identifierLength);
        }

        if($baseServerUrl){
            $config->setBaseUrl($baseServerUrl);
        }
        return $config;
    }

    public function testEncodeReturnsDomainName(): void
    {
        $config = $this->getConfig($this->genericBaseUrl);
        $shorteningService = $this->getGenericUrlShorteningService($config);

        foreach($this->testUrls as $urlToEncode){
            $encodedUrl = $shorteningService->encode($urlToEncode);
            $baseUrlLength = strlen($this->genericBaseUrl);

            $this->assertEquals($this->genericBaseUrl,substr($encodedUrl,0,$baseUrlLength));
        }
    }

    public function testEncodedStringHasOneForwardSlash(){
        $config = $this->getConfig($this->genericBaseUrl);
        $shorteningService = $this->getGenericUrlShorteningService($config);

        foreach($this->testUrls as $urlToEncode){
            $encodedUrl = $shorteningService->encode($urlToEncode);
            $count = substr_count($encodedUrl, '/');
            $this->assertEquals(1,$count);
        }
    }

    public function testEncodeReturnsStringWithConfigCharacterLengthIdentifierAtTheEnd(){
        $identifierLengths = [5,6,7,8];

        foreach($identifierLengths as $identifierLength){
            $config = $this->getConfig(null,$identifierLength);
            $shorteningService = $this->getGenericUrlShorteningService($config);

            foreach($this->testUrls as $urlToEncode){
                $encodedUrl = $shorteningService->encode($urlToEncode);

                $identifier = substr($encodedUrl, strrpos($encodedUrl, '/') + 1);

                $this->assertEquals($identifierLength,strlen($identifier));
            }
        }

    }

}