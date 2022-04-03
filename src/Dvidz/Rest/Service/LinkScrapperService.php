<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Service;

use App\Dvidz\Rest\Model\BookmarkModelDto;
use Embed\Embed;
use Embed\Extractor;

/**
 * Class LinkScrapperService.
 */
class LinkScrapperService implements ScrapperInterface
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
     * @return BookmarkModelDto
     */
    public function scrap(string $url): BookmarkModelDto
    {
        $extractor = $this->scrapper->get($url);
        $extractedData = $extractor->getOEmbed()->all();
        $extractedData['duration'] = $extractedData['duration'] ?? $this->extractMetaValue($extractor, 'duration');
        $extractedData['publishedDate'] = $extractedData['upload_date'] ?? $this->extractMetaValue($extractor, 'datepublished');
        $extractedData['videoWidth'] = $this->extractMetaValue($extractor, 'og:video:width');
        $extractedData['videoHeight']  = $this->extractMetaValue($extractor, 'og:video:height');
        $extractedData['imageWidth']  = $this->extractMetaValue($extractor, 'og:image:width');
        $extractedData['imageHeight']  = $this->extractMetaValue($extractor, 'og:image:height');

        return $this->buildBookmarkModelDto($extractedData, $url);
    }

    /**
     * @param array  $data
     * @param string $url
     *
     * @return BookmarkModelDto
     */
    private function buildBookmarkModelDto(array $data, string $url): BookmarkModelDto
    {
        $bookmarkModelDto = new BookmarkModelDto();
        $bookmarkModelDto->url = $url;
        $bookmarkModelDto->linkTitle = $data['title'] ?? null;
        $bookmarkModelDto->providerName = $data['provider_name'] ?? null;
        $bookmarkModelDto->linkAuthor = $data['author_url'] ?? null;
        $bookmarkModelDto->publishedDate = $data['publishedDate'] ?? null;
        $bookmarkModelDto->type = $data['type'] ?? null;
        $bookmarkModelDto->imageWidth = $data['imageWidth'] ?? null;
        $bookmarkModelDto->imageHeight = $data['imageHeight'] ?? null;
        $bookmarkModelDto->videoWidth = $data['videoWidth'] ?? null;
        $bookmarkModelDto->videoHeight = $data['videoHeight'] ?? null;
        $bookmarkModelDto->videoDuration = $this->formatVideoDuration(strval($data['duration']));

        return $bookmarkModelDto;
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

    /**
     * @param string|null $duration
     *
     * @return string|null
     */
    private function formatVideoDuration(?string $duration): ?string
    {
        //TODO: Format duration strategy.
        return $duration;
    }
}
