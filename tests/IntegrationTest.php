<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

/**
 * Class EncodeTest
 *
 * Should cover the following scenarios:
 * - A URL encoded by the Encode endpoint should be a valid input for the Decode method.
 */
class IntegrationTest extends TestCase
{
    public function testTest(): void
    {
        $this->assertEquals(1,1);
    }

}