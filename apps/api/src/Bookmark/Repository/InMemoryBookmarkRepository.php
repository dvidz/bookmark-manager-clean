<?php

declare(strict_types=1);

namespace Api\Bookmark\Repository;

use Api\Bookmark\Entity\Bookmark as BookmarkEntity;
use Dvidz\Bookmark\Domain\Bookmark;
use Dvidz\Bookmark\Domain\Repository\BookmarkRepository as DomainBookmarkRepository;

/**
 * Class InMemoryBookmarkRepository.
 */
class InMemoryBookmarkRepository implements DomainBookmarkRepository
{
    /**
     * @var BookmarkEntity[]
     */
    protected array $bookmarks;

    /**
     * @param Bookmark $bookmark
     *
     * @return void
     */
    public function bookmark(Bookmark $bookmark): void
    {
        $bookmarkEntity = BookmarkEntity::fromArray($bookmark->toArray());

        $this->addBookmark($bookmarkEntity);
    }

    /**
     * @param string $uuid
     *
     * @return BookmarkEntity
     */
    public function getBookmark(string $uuid)
    {
        return $this->bookmarks[$uuid];
    }

    /**
     * @param BookmarkEntity $bookmarkEntity
     *
     * @return void
     */
    private function addBookmark(BookmarkEntity $bookmarkEntity)
    {
        $this->bookmarks[$bookmarkEntity->getUuid()] = $bookmarkEntity;
    }
}
