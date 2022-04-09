<?php

declare(strict_types=1);

namespace Api\Bookmark\Bus\Command;

use Dvidz\Bookmark\Application\Create\Command\BookmarkCommand;
use Dvidz\Bookmark\Application\Create\Command\BookmarkCommandHandler;
use Dvidz\Shared\Domain\Bus\Command\Command;
use Dvidz\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

/**
 * Class BookmarkCommandBus.
 */
class BookmarkCommandBus implements CommandBus
{
    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $bus;

    /**
     * @param BookmarkCommandHandler $bookmarkCommandHandler
     */
    public function __construct(BookmarkCommandHandler $bookmarkCommandHandler)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                BookmarkCommand::class => [$bookmarkCommandHandler],
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
