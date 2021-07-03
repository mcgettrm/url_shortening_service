<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use UrlShortener\DomainObjects\Models\ShortLink;

/**
 * Class DecodeTest
 *
 * This class should cover the following scenarios
 * - Should accept an IDENTIFIER.
 * - Should accept the IDENTIFIER with or without the CONFIG_URL
 * - Should return the original LONG_URL [DONE].
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

        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
        $shortLink = new ShortLink();
        $shortLink->setLongUrl($longUrl);
        $shortLink->setIdentifier($identifier);
        $shortLink->setShortUrl($shortUrl);
        $shortLinkRepository->method('read')->willReturn($shortLink);
        $shortenerService = $this->getGenericUrlShorteningService(null, $shortLinkRepository);

        $this->assertEquals($longUrl,$shortenerService->decode($this->genericDecodeString));
    }

    public function testReturnsCorrectLongUrlIfOnlyIdentifierIsPassed(){
        $longUrl = 'www.snuggle.com/marketing/my_amazing_campagin/extreme_pillows_deal';
        $shortUrl = "http://url_shortening_service/YTlkMT";
        $identifier = "YTlkMT";

        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
        $shortLink = new ShortLink();
        $shortLink->setLongUrl($longUrl);
        $shortLink->setIdentifier($identifier);
        $shortLink->setShortUrl($shortUrl);
        $shortLinkRepository->method('read')->willReturn($shortLink);
        $shortenerService = $this->getGenericUrlShorteningService(null, $shortLinkRepository);

        $this->assertEquals($longUrl,$shortenerService->decode($identifier));
    }

    public function testEncodedURLDecodesCorrectly(){
        $shortLink = new ShortLink();
        $shortLink->setLongUrl($this->genericTestLongUrl);
        $shortLink->setIdentifier('NmI2MW');
        $shortLink->setShortUrl('http://url_shortening_service/NmI2MW');
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);

        //First call will return false, triggering the create, second call will be the decode method
        $shortLinkRepository->expects($this->any())->method('read')->will($this->onConsecutiveCalls(false, $shortLink));
        $shortLinkRepository->expects($this->once())->method('create');

        $shortLinkRepository->method('read')->willReturn($shortLink);
        $urlShortenerService = $this->getGenericUrlShorteningService(null, $shortLinkRepository);
        $encodedUrl = $urlShortenerService->encode($this->genericTestLongUrl);

        $this->assertEquals($this->genericTestLongUrl, $urlShortenerService->decode($encodedUrl));
    }



}