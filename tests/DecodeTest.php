<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

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
        $config = $this->getConfig();
        $shortenerService = $this->getGenericUrlShorteningService($config);

        $this->assertEquals(1,$shortenerService->decode($this->genericDecodeString));
    }

}