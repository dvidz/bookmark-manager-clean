<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Service;

use Embed\Embed;
use Embed\Extractor;

/**
 * Class LinkScrapperService.
 */
class LinkCrawlerService implements CrawlerInterface
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
     * @return array
     */
    public function crawl(string $url): array
    {
        $extractor = $this->scrapper->get($url);
        $extractedData = $extractor->getOEmbed()->all();
        $extractedData['duration'] = $extractedData['duration'] ?? $this->extractMetaValue($extractor, 'duration');
        $extractedData['publishedDate'] = $extractedData['upload_date'] ?? $this->extractMetaValue($extractor, 'datepublished');
        $extractedData['videoWidth'] = $extractedData['width'] ?? $this->extractMetaValue($extractor, 'og:video:width');
        $extractedData['videoHeight']  = $extractedData['height'] ?? $this->extractMetaValue($extractor, 'og:video:height');
        $extractedData['imageWidth']  = $this->extractMetaValue($extractor, 'og:image:width');
        $extractedData['imageHeight']  = $this->extractMetaValue($extractor, 'og:image:height');

        return $extractedData;
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
