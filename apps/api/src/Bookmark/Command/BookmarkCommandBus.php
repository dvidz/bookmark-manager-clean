<?php

declare(strict_types=1);

namespace Api\Bookmark\Command;

use Dvidz\Shared\Domain\Command\Command;
use Dvidz\Shared\Domain\Command\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class BookmarkCommandBus.
 */
class BookmarkCommandBus implements CommandBus
{
    /**
     * @param MessageBusInterface $commandBus
     */
    public function __construct(protected MessageBusInterface $commandBus)
    {
    }

    /**
     * @param Command $command
     *
     * @return void
     */
    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
