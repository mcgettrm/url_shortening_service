<?php
namespace UrlShortener\Repositories;

use UrlShortener\Config;
use UrlShortener\DomainObjects\Models\ShortLink;

class ShortLinkRepository
{
    /**
     * In the absence of persistence data, this array is effectively the persistence
     * @var array
     */
    private array $shortLinksArray;

    /**
     * The application's config object
     * @var Config
     */
    private Config $config;

    /**
     * ShortLinkRepository constructor.
     * @param Config $config
     */
    public function __construct(Config $config){
        $this->config = $config;
        $this->loadAll();
    }

    /**
     * Loads all persistent data into memory
     */
    private function loadAll(){
        //'identifier' // long url // short url
        $this->shortLinksArray = [
            ['MTMwMG','www.snuggle.com','http://url_shortening_service/MTMwMG'],
            ['YTlkMT','www.snuggle.com/marketing/my_amazing_campagin/extreme_pillows_deal','http://url_shortening_service/YTlkMT'],
            ['NmViY2','www.tables.com/mega-deals/outdoor-tables/summer-sale/50-percent-off','http://url_shortening_service/NmViY2']
        ];
    }

    /**
     * Saves data array to persistent storage
     */
    private function persist(){
        $this->shortLinksArray;
    }

    /**
     * Create a new entry in persistence
     * @param string $identifier
     * @param string $longUrl
     * @param string $shortUrl
     */
    public function create(string $identifier,string $longUrl,string $shortUrl){
        $this->shortLinksArray[] = [$identifier,$longUrl, $shortUrl];
        $this->persist();
    }

    /**
     * If found, return instance of domain object, if not return false
     * @param string $identifier
     * @return ShortLink|bool
     */
    public function read(string $identifier){

        foreach($this->shortLinksArray as $shortLinkArray){
            if($shortLinkArray[0] == $identifier){
                $shortLink = new ShortLink();
                $shortLink->setIdentifier($shortLinkArray[0]);
                $shortLink->setLongUrl($shortLinkArray[1]);
                $shortLink->setShortUrl($shortLinkArray[2]);
                return $shortLink;
            }
        }

        return false;
    }

    /**
     * Update the passed shortlink's entry in persistence
     * @param ShortLink $shortLink
     * @return bool
     */
    public function update(ShortLink $shortLink):bool{
        return true;
    }

    /**
     * Delete the passed shortlink from presistence
     * @param ShortLink $shortLink
     * @return bool
     */
    public function delete(ShortLink $shortLink):bool{
        return true;
    }
}