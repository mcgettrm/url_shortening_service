<?php
namespace UrlShortener\DomainObjects\Services;

use UrlShortener\Repositories\ShortLinkRepository;

class UrlShortenerService
{

    private ShortLinkRepository $shortLinkRepository;

    public function __construct(
        ShortLinkRepository $shortLinkRepository
    ){
        $this->shortLinkRepository = $shortLinkRepository;
    }
}