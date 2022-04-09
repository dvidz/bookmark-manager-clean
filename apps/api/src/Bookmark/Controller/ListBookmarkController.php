<?php

declare(strict_types=1);

namespace Api\Bookmark\Controller;

use Api\Bookmark\Bus\Presenter\BookmarkListPresenter;
use Api\Bookmark\Bus\Response\BookmarkListViewModel;
use Dvidz\Bookmark\Application\List\Query\ListQuery;
use Dvidz\Shared\Domain\Bus\Command\CommandBus;
use Dvidz\Shared\Domain\Bus\Query\QueryBus;
use Dvidz\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ListBookmarkController
 */
class ListBookmarkController extends AbstractController
{
    /**
     * @param CommandBus          $commandBus
     * @param QueryBus            $queryBus
     * @param SerializerInterface $serializer
     */
    public function __construct(private CommandBus $commandBus, private QueryBus $queryBus, protected SerializerInterface $serializer)
    {
        parent::__construct($this->commandBus, $this->queryBus);
    }

    /**
     * @param BookmarkListPresenter $bookmarkListPresenter
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $listViewModel = new BookmarkListViewModel();
        $response = $this->ask(new ListQuery())->respond();

        $view = $listViewModel->create($response)->getView();

        return new JsonResponse($view, Response::HTTP_OK);
    }
}
