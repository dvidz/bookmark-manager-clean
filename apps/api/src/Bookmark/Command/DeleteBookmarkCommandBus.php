<?php

declare(strict_types=1);

namespace Api\Bookmark\Command;

use Dvidz\Bookmark\Application\DeleteBookmark\DeleteBookmarkCommand;
use Dvidz\Bookmark\Application\DeleteBookmark\DeleteBookmarkCommandHandler;
use Dvidz\Shared\Domain\Command\Command;
use Dvidz\Shared\Domain\Command\CommandBus;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

/**
 * Class DeleteBookmarkCommandBus.
 */
class DeleteBookmarkCommandBus implements CommandBus
{
    /**
     * @param MessageBusInterface $commandBus
     */
    public function __construct(private MessageBusInterface $commandBus)
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
