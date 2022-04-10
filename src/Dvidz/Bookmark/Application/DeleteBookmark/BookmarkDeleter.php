<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\DeleteBookmark;

use Dvidz\Bookmark\Domain\Repository\DeleteBookmarkRepository;

/**
 * Class BookmarkDeleter.
 */
class BookmarkDeleter
{
    /**
     * @var DeleteBookmarkRepository
     */
    protected DeleteBookmarkRepository $deleteBookmarkRepository;

    /**
     * @param DeleteBookmarkRepository $deleteBookmarkRepository
     */
    public function __construct(DeleteBookmarkRepository $deleteBookmarkRepository)
    {
        $this->deleteBookmarkRepository = $deleteBookmarkRepository;
    }

    /**
     * @param string $uuid
     *
     * @return void
     */
    public function delete(string $uuid)
    {
        $this->deleteBookmarkRepository->deleteBookmark($uuid);
    }
}
