<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\Create\Command;

use Dvidz\Bookmark\Domain\Bookmark;
use Dvidz\Bookmark\Domain\Exception\UrlException;
use Dvidz\Bookmark\Domain\Repository\BookmarkRepository;
use Dvidz\Bookmark\Domain\Specification\UrlSpecification;
use Dvidz\Bookmark\Domain\Url;
use Dvidz\Shared\Domain\ValueObject\UuidInterface;

/**
 * Class BookmarkCreator.
 */
class BookmarkCreator
{
    /**
     * @param BookmarkRepository $bookmarkRepository
     * @param UuidInterface      $uuid
     * @param UrlSpecification   $urlSpecification
     */
    public function __construct(protected BookmarkRepository $bookmarkRepository, protected UuidInterface $uuid, protected UrlSpecification $urlSpecification)
    {
    }

    /**
     * @param string   $url
     * @param string   $provider
     * @param string   $title
     * @param string   $author
     * @param string   $publishedAt
     * @param string   $type
     * @param int      $width
     * @param int      $height
     * @param int|null $duration
     *
     * @return Bookmark
     *
     * @throws UrlException
     */
    public function bookmark(string $url, string $provider, string $title, string $author, string $publishedAt, string $type, int $width, int $height, ?int $duration): Bookmark
    {
        $url = new Url($url);
        $this->urlSpecification->isValidUrl($url);

        $bookmark = Bookmark::bookmark($this->uuid, $url, $provider, $title, $author, $publishedAt, $type, $width, $height, $duration);
        $this->bookmarkRepository->bookmark($bookmark);

        return $bookmark;
    }
}
