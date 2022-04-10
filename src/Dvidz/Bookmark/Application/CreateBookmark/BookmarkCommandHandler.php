<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\CreateBookmark;

use Dvidz\Shared\Domain\Command\Command;
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
     * @param Command $bookmarkCommand
     *
     * @throws \Exception
     */
    public function __invoke(Command $bookmarkCommand): void
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
