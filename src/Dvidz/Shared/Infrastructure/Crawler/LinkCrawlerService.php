<?php

declare(strict_types=1);

namespace Dvidz\Shared\Infrastructure\Crawler;

use Dvidz\Bookmark\Application\CrawlUrl\UrlCrawler;
use Dvidz\Bookmark\Application\CrawlUrl\UrlCrawlerResponse;
use Embed\Embed;
use Embed\Extractor;

/**
 * Class LinkScrapperService.
 */
class LinkCrawlerService implements UrlCrawler
{
    /**
     * @var Embed
     */
    protected Embed $scrapper;

    /**
     * @param Embed $scrapper
     */
    public function __construct(Embed $scrapper)
    {
        $this->scrapper = $scrapper;
    }

    /**
     * @param string $url
     *
     * @return UrlCrawlerResponse
     */
    public function crawl(string $url): UrlCrawlerResponse
    {
        $extractor = $this->scrapper->get($url);

        $oEmbed = $extractor->getOEmbed()->all();
        $meta = $extractor->getMetas()->all();
        $data = array_merge($oEmbed, $meta);

        return new UrlCrawlerResponse($data);
    }
}
