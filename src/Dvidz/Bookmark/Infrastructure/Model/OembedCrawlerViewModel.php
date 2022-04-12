<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Infrastructure\Model;

use Dvidz\Shared\Domain\Model\ViewModel;
use Dvidz\Shared\Domain\Response\Response;

/**
 * Class OembedCrawlerViewModel.
 */
class OembedCrawlerViewModel implements ViewModel
{
    /**
     * @param string   $publishedAt
     * @param string   $type
     * @param ?string  $url
     * @param string   $title
     * @param string   $provider
     * @param string   $author
     * @param int      $width
     * @param int      $height
     * @param int|null $duration
     */
    private function __construct(public string $publishedAt, public string $type, public ?string $url, public string $title, public string $provider, public string $author, public int $width, public int $height, public ?int $duration)
    {
    }

    /**
     * @param Response $response
     *
     * @return static
     */
    public static function createFromResponse(Response $response): self
    {
        $data = $response->respond();

        return new self(
            $data['upload_date'] ?? $data['og:updated_time'][0],
            $data['type'],
            $data['url'] ?? null,
            is_array($data['title']) ? $data['title'][0] : $data['title'],
            $data['provider_name'],
            $data['author_name'],
            $data['width'],
            $data['height'],
            $data['duration'] ?? null
        );
    }
}
