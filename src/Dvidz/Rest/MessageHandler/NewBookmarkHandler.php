<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\MessageHandler;

use App\Dvidz\Rest\Message\NewBookmark;
use App\Dvidz\Rest\Repository\BookmarkRepositoryInterface;

/**
 * Class NewBookmarkHandler.
 */
class NewBookmarkHandler
{
    /**
     * @var BookmarkRepositoryInterface
     */
    protected BookmarkRepositoryInterface $bookmarkRepository;

    /**
     * @param BookmarkRepositoryInterface $bookmarkRepository
     */
    public function __construct(BookmarkRepositoryInterface $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    /**
     * @param NewBookmark $newBookmark
     *
     * @return void
     */
    public function __invoke(NewBookmark $newBookmark)
    {
        $bookmark = $this->bookmarkRepository->find($newBookmark->getBookmarkId());

        // TODO: DO whatever you want with this bookmark : send email, connect external cloud service...
    }
}
