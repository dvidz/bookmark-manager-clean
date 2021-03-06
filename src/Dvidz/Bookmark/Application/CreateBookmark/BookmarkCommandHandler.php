<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\CreateBookmark;

use Dvidz\Bookmark\Domain\Exception\UrlAlreadyBookmarkedException;
use Dvidz\Bookmark\Domain\Exception\UrlException;
use Dvidz\Shared\Domain\Command\CommandHandler;

/**
 * Class BookmarkCommandHandler
 */
class BookmarkCommandHandler implements CommandHandler
{
    /**
     * @param BookmarkCreator $bookmarkCreator
     */
    public function __construct(protected BookmarkCreator $bookmarkCreator)
    {
    }

    /**
     * @param BookmarkCommand $bookmarkCommand
     *
     * @return void
     *
     * @throws UrlException|UrlAlreadyBookmarkedException
     */
    public function __invoke(BookmarkCommand $bookmarkCommand): void
    {
        $this->bookmarkCreator->bookmark(
            $bookmarkCommand->url,
            $bookmarkCommand->provider,
            $bookmarkCommand->title,
            $bookmarkCommand->author,
            $bookmarkCommand->publishedAt,
            $bookmarkCommand->type,
            $bookmarkCommand->with,
            $bookmarkCommand->height,
            $bookmarkCommand->duration,
        );
    }
}
