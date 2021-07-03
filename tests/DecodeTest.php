<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use UrlShortener\DomainObjects\Models\ShortLink;

/**
 * Class DecodeTest
 *
 * This class should cover the following scenarios
 * - Should accept an IDENTIFIER.
 * - Should validate that IDENTIFIER is 6 characters (or return status code 400).
 * - Should validate that IDENTIFIER is made of valid HTTP URL characters (or return status code 400).
 * - Should accept the IDENTIFIER with or without the CONFIG_URL
 * - Should return the original LONG_URL on success (or return status code 404).
 * - Should only accept SHORT_URL from the CONFIG_DOMAIN_NAME
 * - If a short URL is passed that has an incorrect CONFIG_DOMAIN_NAME, fail and return status code 400
 *
 */
class DecodeTest extends AbstractUrlShortenerServiceTest
{

    private $genericDecodeString = "http://url_shortening_service/YTlkMT";
    public function testReturnsLongUrlIfIdentifierFoundInRepository(): void
    {
        $longUrl = 'www.snuggle.com/marketing/my_amazing_campagin/extreme_pillows_deal';
        $shortUrl = "http://url_shortening_service/YTlkMT";
        $identifier = "YTlkMT";

        $config = $this->getConfig();
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
        $shortLink = new ShortLink();
        $shortLink->setLongUrl($longUrl);
        $shortLink->setIdentifier($identifier);
        $shortLink->setShortUrl($shortUrl);
        $shortLinkRepository->method('read')->willReturn($shortLink);
        $shortenerService = $this->getGenericUrlShorteningService($config, $shortLinkRepository);

        $this->assertEquals($longUrl,$shortenerService->decode($this->genericDecodeString));
    }

}