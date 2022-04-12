<?php

declare(strict_types=1);

namespace Api\Bookmark\Repository;

use Dvidz\Bookmark\Domain\Entity\Bookmark;
use Dvidz\Bookmark\Domain\Repository\BookmarkRepository as DomainBookmarkRepository;

/**
 * Class InMemoryBookmarkRepository.
 */
class InMemoryBookmarkRepository implements DomainBookmarkRepository
{
    /**
     * @var Bookmark[]
     */
    protected array $bookmarks;

    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    public function bookmark(Bookmark $bookmark): void
    {
        $this->addBookmark($bookmark);
    }

    /**
     * @param string $url
     *
     * @return Bookmark|null
     */
    public function findOneByUrl(string $url): ?Bookmark
    {
        return null;
    }

    /**
     * @param string $uuid
     *
     * @return Bookmark
     */
    public function getBookmark(string $uuid): Bookmark
    {
        return $this->bookmarks[$uuid];
    }

    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    private function addBookmark(Bookmark $bookmark)
    {
        $this->bookmarks[$bookmark->uuid()] = $bookmark;
    }
}
