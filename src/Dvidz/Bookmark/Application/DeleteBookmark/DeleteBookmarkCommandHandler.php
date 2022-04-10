<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\DeleteBookmark;

use Dvidz\Shared\Domain\Command\Command;
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
     * @param DeleteBookmarkCommande $command
     *
     * @return void
     */
    public function __invoke(Command $command): void
    {
        $this->bookmarkDeleter->delete($command->uuid);
    }
}
