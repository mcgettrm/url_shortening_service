<?php

use PHPUnit\Framework\TestCase;
use UrlShortener\Config;
use UrlShortener\DomainObjects\Services\UrlShortenerService;

abstract class AbstractUrlShortenerServiceTest extends TestCase
{

    protected $genericTestLongUrl = "www.mcgettrixelectrix.co.uk/my_ad_campaign/massive_summer_sale";
    /**
     * @param Config $config
     * @param null $shortLinkRepository
     * @return \UrlShortener\DomainObjects\Services\UrlShortenerService
     */
    protected function getGenericUrlShorteningService(Config $config = null, $shortLinkRepository = null):UrlShortenerService{

        if(!$config){
            $config = $this->getConfig();
        }
        if(!$shortLinkRepository){
            $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
            $shortLinkRepository->method('read')->willReturn(false);
        }

        $shorteningService = new \UrlShortener\DomainObjects\Services\UrlShortenerService(
            $config,
            $shortLinkRepository
        );

        return $shorteningService;
    }

    /**
     * @param null $baseServerUrl
     * @param null $identifierLength
     * @return Config
     */
    protected function getConfig($baseServerUrl = null, $identifierLength = null):Config{
        $config = new Config();
        if($identifierLength){
            $config->setIdentifierLength($identifierLength);
        }

        if($baseServerUrl){
            $config->setBaseUrl($baseServerUrl);
        }
        return $config;
    }
}