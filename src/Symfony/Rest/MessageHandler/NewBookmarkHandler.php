<?php

declare(strict_types=1);

namespace App\Symfony\Rest\MessageHandler;

use App\Symfony\Rest\Message\NewBookmark;
use App\Symfony\Rest\Repository\BookmarkRepositoryInterface;

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
