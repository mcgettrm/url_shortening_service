<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

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
    public function testTest(): void
    {
        $this->assertEquals(1,1);
    }

}