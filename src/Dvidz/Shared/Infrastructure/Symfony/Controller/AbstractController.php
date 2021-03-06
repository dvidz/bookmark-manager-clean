<?php

declare(strict_types=1);

namespace Dvidz\Shared\Infrastructure\Symfony\Controller;

use Dvidz\Shared\Domain\Command\Command;
use Dvidz\Shared\Domain\Command\CommandBus;
use Dvidz\Shared\Domain\Model\ItemViewModel;
use Dvidz\Shared\Domain\Model\ListViewModel;
use Dvidz\Shared\Domain\Model\ViewModel;
use Dvidz\Shared\Domain\Presenter\Presenter;
use Dvidz\Shared\Domain\Query\Query;
use Dvidz\Shared\Domain\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

/**
 * Class AbstractController.
 */
abstract class AbstractController extends SymfonyAbstractController
{
    /**
     * @param CommandBus|null $commandBus
     * @param QueryBus|null   $queryBus
     * @param Presenter|null  $presenter
     */
    public function __construct(private ?CommandBus $commandBus, private ?QueryBus $queryBus, private ?Presenter $presenter)
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
     * @return ViewModel|ListViewModel|ItemViewModel
     */
    protected function ask(Query $query): ViewModel|ListViewModel|ItemViewModel
    {
        $response = $this->queryBus->ask($query);
        $this->presenter->present($response);

        return $this->presenter->getView();
    }
}
