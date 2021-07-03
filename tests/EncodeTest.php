<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use UrlShortener\Config;

/**
 * Class EncodeTest
 *
 * Should cover the following scenarios:
 * - Should generate a 6-character IDENTIFIER from an input LONG_URL.
 * - Should confirm that LONG_URL is a valid URL (or return status code 400).
 * - Identifier should be unique.
 * - Should return a string CONFIG_DOMAIN_NAME/IDENTIFIER to the caller.
 * - IDENTIFIER should be a valid HTTP URL.
 */
class EncodeTest extends TestCase
{
    private $genericUrlToEncode ="www.mcgettrixelectrix.co.uk/my_ad_campaign";
    public function testEncodeReturnsDomainName(): void
    {
        $baseServerUrl = "my_base_url.co.uk";

        $config = new Config();
        $config->setBaseUrl($baseServerUrl);
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);

        $shorteningService = new \UrlShortener\DomainObjects\Services\UrlShortenerService(
            $config,
            $shortLinkRepository
        );

        $encodedUrl = $shorteningService->encode($this->genericUrlToEncode);
        $baseUrlLength = strlen($baseServerUrl);

        $this->assertEquals($baseServerUrl,substr($encodedUrl,0,$baseUrlLength));
    }

}