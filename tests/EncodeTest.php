<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use UrlShortener\Config;
use UrlShortener\DomainObjects\Models\ShortLink;

/**
 * Class EncodeTest
 *
 * Should cover the following scenarios:
 * - Should return a string CONFIG_DOMAIN_NAME at the beginning to the caller. [DONE]
 * - Encoded URL should have only one / [DONE]
 * - Should be saved in persistence
 * - Does not save in persistence if the identifier already exists (identifier is unique)
 */
class EncodeTest extends AbstractUrlShortenerServiceTest
{
    protected $genericBaseUrl = "my_base_url.co.uk";

    //Using an array here so that we can easily add new example urls
    private $testUrls = [
        'www.mcgettrixelectrix.co.uk/my_ad_campaign'
    ];

    private function getIdentifierFromEncodedUrl($encodedUrl){
        $identifier = substr($encodedUrl, strrpos($encodedUrl, '/') + 1);
        return $identifier;
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
                $identifier = $this->getIdentifierFromEncodedUrl($encodedUrl);


                $this->assertEquals($identifierLength,strlen($identifier));
            }
        }

    }

    public function testEncodeSavesTheGeneratedShortLink(){
        $config = $this->getConfig($this->genericBaseUrl);
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
        $shortLinkRepository->method('read')->willReturn(false);
        $shortLinkRepository->expects($this->once())->method('create');


        $shorteningService = $this->getGenericUrlShorteningService($config, $shortLinkRepository);
        $encodedUrl = $shorteningService->encode($this->genericTestLongUrl);
    }

    public function testRepositoryAskedIfARecordAlreadyExists(){
        $config = $this->getConfig($this->genericBaseUrl);
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
        $shortLinkRepository->method('read')->willReturn(false);

        //If read returns an instance of ShortLink
        $shortLinkRepository->expects($this->once())->method('read');

        $shorteningService = $this->getGenericUrlShorteningService($config, $shortLinkRepository);
        $encodedUrl = $shorteningService->encode($this->genericTestLongUrl);
    }


    /**
     *
     * When duplicte long URLS are not allowed, we should return the old shortlink.
     */
    public function testEncodeDoesNotCreateIfIdentifierAlreadyExistsAndDuplicateLongUrlsNotAllowed(){
        $config = $this->getConfig($this->genericBaseUrl);
        $config->setAllowDuplicateLongURLs(false);
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
        $shortLink = $this->createMock(ShortLink::class);
        $shortLink->method('getLongUrl')->willReturn($this->genericTestLongUrl);

        $shortLinkRepository->expects($this->any())->method('read')->willReturn($shortLink);
        $shortLinkRepository->expects($this->never())->method('create');

        $shorteningService = $this->getGenericUrlShorteningService($config, $shortLinkRepository);
        $encodedUrl = $shorteningService->encode($this->genericTestLongUrl);
    }

    /**
     * When duplicate long URLS are allowed, we should create a new identifier and return new shortlink.
     */
    public function testEncodeWillCreateIfIdentifierAlreadyExistsAndDuplicateLongUrlsAreAllowed(){
        $config = $this->getConfig($this->genericBaseUrl);
        $config->setAllowDuplicateLongURLs(true);
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
        $shortLink = $this->createMock(ShortLink::class);
        $shortLink->method('getLongUrl')->willReturn($this->genericTestLongUrl);

        $shortLinkRepository->expects($this->any())->method('read')->will($this->onConsecutiveCalls($shortLink, false));
        $shortLinkRepository->expects($this->once())->method('create');

        $shorteningService = $this->getGenericUrlShorteningService($config, $shortLinkRepository);
        $encodedUrl = $shorteningService->encode($this->genericTestLongUrl);
    }

    public function testEncodedUrlIsUrlSafe(){
        $config = $this->getConfig($this->genericBaseUrl);
        $shortLinkRepository = $this->createMock(\UrlShortener\Repositories\ShortLinkRepository::class);
        $shortLinkRepository->method('read')->willReturn(false);
        $shorteningService = $this->getGenericUrlShorteningService($config, $shortLinkRepository);
        $encodedUrl = $shorteningService->encode($this->genericTestLongUrl);

        $identifier = $this->getIdentifierFromEncodedUrl($encodedUrl);

        //Should only contain numbers and letters
        $this->assertEquals(0, preg_match('/[^A-Za-z0-9]/', $identifier));

    }

}