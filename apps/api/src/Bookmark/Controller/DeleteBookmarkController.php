<?php

declare(strict_types=1);

namespace Api\Bookmark\Controller;

use Api\Bookmark\Command\DeleteBookmarkCommandBus;
use Dvidz\Bookmark\Application\DeleteBookmark\DeleteBookmarkCommand;
use Dvidz\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DeleteBookmarkController
 */
class DeleteBookmarkController extends AbstractController
{
    /**
     * @param DeleteBookmarkCommandBus $commandBus
     */
    public function __construct(private DeleteBookmarkCommandBus $commandBus)
    {
        parent::__construct($this->commandBus, null, null);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $id = $request->get('id');
        $this->dispatch(new DeleteBookmarkCommand($id));

        return new JsonResponse('removed', Response::HTTP_NO_CONTENT);
    }
}
