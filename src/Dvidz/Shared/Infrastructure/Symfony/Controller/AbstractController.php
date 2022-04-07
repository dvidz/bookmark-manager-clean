<?php

declare(strict_types=1);

namespace Dvidz\Shared\Infrastructure\Symfony\Controller;

use Dvidz\Shared\Domain\Bus\Command\CommandBus;
use Dvidz\Shared\Domain\Bus\Command\Command;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

/**
 * Class AbstractController.
 */
class AbstractController extends SymfonyAbstractController
{
    /**
     * @param CommandBus $commandBus
     */
    public function __construct(private CommandBus $commandBus)
    {
    }

    /**
     * @param Command $command
     *
     * @return void
     */
    protected function dispatch(Command $command)
    {
        $this->commandBus->dispatch($command);
    }
}
