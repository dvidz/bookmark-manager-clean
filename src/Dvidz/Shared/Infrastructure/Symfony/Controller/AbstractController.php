<?php

declare(strict_types=1);

namespace Dvidz\Shared\Infrastructure\Symfony\Controller;

use Dvidz\Shared\Domain\Bus\Command\CommandBus;
use Dvidz\Shared\Domain\Bus\Command\Command;
use Dvidz\Shared\Domain\Bus\Query\Query;
use Dvidz\Shared\Domain\Bus\Query\QueryBus;
use Dvidz\Shared\Domain\Bus\Response\Response;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

/**
 * Class AbstractController.
 */
abstract class AbstractController extends SymfonyAbstractController
{
    /**
     * @param CommandBus $commandBus
     */
    public function __construct(private CommandBus $commandBus, private QueryBus $queryBus)
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

    /**
     * @param Query $query
     *
     * @return Response|null
     */
    protected function ask(Query $query): ?Response
    {
        return $this->queryBus->ask($query);
    }
}
