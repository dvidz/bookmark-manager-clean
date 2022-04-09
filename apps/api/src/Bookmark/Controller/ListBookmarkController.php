<?php

declare(strict_types=1);

namespace Api\Bookmark\Controller;

use Dvidz\Bookmark\Application\ListBookmark\ListBookmarkQuery;
use Dvidz\Bookmark\Infrastructure\Presenter\BookmarkListPresenter;
use Dvidz\Shared\Domain\Command\CommandBus;
use Dvidz\Shared\Domain\Query\QueryBus;
use Dvidz\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListBookmarkController
 */
class ListBookmarkController extends AbstractController
{
    /**
     * @param CommandBus            $commandBus
     * @param QueryBus              $queryBus
     * @param BookmarkListPresenter $presenter
     */
    public function __construct(private CommandBus $commandBus, private QueryBus $queryBus, private BookmarkListPresenter $presenter)
    {
        parent::__construct($this->commandBus, $this->queryBus, $this->presenter);
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $viewModel = $this->ask(new ListBookmarkQuery());

        return new JsonResponse($viewModel->list(), Response::HTTP_OK);
    }
}
