<?php

namespace Dvidz\Bookmark\Infrastructure\Controller;

use Dvidz\Bookmark\Application\Bus\Command\BookmarkCommand;
use Dvidz\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookmarkController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $this->dispatch(
            new BookmarkCommand(
                'http://vimeo.com/776645778',
                'Vimeo',
                'Super titre',
                'David .S',
                '2019-04-23',
                'video',
                1080,
                720,
                254
            )
        );

        return new JsonResponse('hello from clean', Response::HTTP_OK);
    }

}