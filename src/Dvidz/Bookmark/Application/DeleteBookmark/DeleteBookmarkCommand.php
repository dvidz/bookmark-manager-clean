<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Application\DeleteBookmark;

use Dvidz\Shared\Domain\Command\Command;

/**
 * Class DeleteBookmarkCommand.
 */
class DeleteBookmarkCommand implements Command
{
    /**
     * @param string $uuid
     */
    public function __construct(public string $uuid)
    {
    }
}
