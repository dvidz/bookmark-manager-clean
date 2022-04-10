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

        return new UrlCrawlerResponse($oEmbed);
    }

    /**
     * @param Extractor $extractor
     * @param string    $metaName
     *
     * @return string|null
     */
    private function extractMetaValue(Extractor $extractor, string $metaName): ?string
    {
        $meta = $extractor->getMetas()->get($metaName);

        if (is_array($meta)) {
            $meta = $meta[0] ?? null;
        }

        return $meta ?? null;
    }
}
