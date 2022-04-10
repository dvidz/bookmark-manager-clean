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
     * @var MessageBusInterface
     */
    private MessageBusInterface $bus;

    /**
     * @param DeleteBookmarkCommandHandler $deleteBookmarkCommandHandler
     */
    public function __construct(DeleteBookmarkCommandHandler $deleteBookmarkCommandHandler)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                DeleteBookmarkCommand::class => [$deleteBookmarkCommandHandler],
            ])),
        ]);
    }


    /**
     * @param Command $command
     *
     * @return void
     */
    public function dispatch(Command $command): void
    {
        $this->bus->dispatch($command);
    }
}
