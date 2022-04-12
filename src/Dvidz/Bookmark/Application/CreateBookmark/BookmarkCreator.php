<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\CreateBookmark;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Bookmark\Domain\Entity\ValueType\Url;
use Dvidz\Bookmark\Domain\Exception\UrlAlreadyBookmarkedException;
use Dvidz\Bookmark\Domain\Exception\UrlException;
use Dvidz\Bookmark\Domain\Repository\BookmarkRepository;
use Dvidz\Bookmark\Domain\Specification\UniqueUrlSpecification;
use Dvidz\Bookmark\Domain\Specification\UrlSpecification;
use Dvidz\Shared\Domain\Entity\ValueObject\UuidInterface;

/**
 * Class BookmarkCreator.
 */
class BookmarkCreator
{
    /**
     * @param BookmarkRepository     $bookmarkRepository
     * @param UuidInterface          $uuid
     * @param UrlSpecification       $urlSpecification
     * @param UniqueUrlSpecification $uniqueUrlSpecification
     */
    public function __construct(
        protected BookmarkRepository $bookmarkRepository,
        protected UuidInterface $uuid,
        protected UrlSpecification $urlSpecification,
        protected UniqueUrlSpecification $uniqueUrlSpecification
    ) {
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
     * @throws UrlException|UrlAlreadyBookmarkedException
     */
    public function bookmark(
        string $url,
        string $provider,
        string $title,
        string $author,
        string $publishedAt,
        string $type,
        int $width,
        int $height,
        ?int $duration
    ) {
        $url = new Url($url);
        $this->urlSpecification->isValidUrl($url);
        $this->uniqueUrlSpecification->isUniqueUrl($url);

        $bookmark = Bookmark::bookmark($this->uuid, $url, $provider, $title, $author, $publishedAt, $type, $width, $height, $duration);
        $this->bookmarkRepository->bookmark($bookmark);
    }
}
