<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\DeleteBookmark;

use Dvidz\Shared\Domain\Command\CommandHandler;

/**
 * Class DeleteBookmarkCommandHandler.
 */
class DeleteBookmarkCommandHandler implements CommandHandler
{
    /**
     * @param BookmarkDeleter $bookmarkDeleter
     */
    public function __construct(protected BookmarkDeleter $bookmarkDeleter)
    {
    }

    /**
     * @param DeleteBookmarkCommand $command
     *
     * @return void
     */
    public function __invoke(DeleteBookmarkCommand $command): void
    {
        $this->bookmarkDeleter->delete($command->uuid);
    }
}
