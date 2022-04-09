<?php

declare(strict_types=1);

namespace Api\Bookmark\Controller;

use Dvidz\Bookmark\Application\List\Query\ListQuery;
use Dvidz\Shared\Infrastructure\Symfony\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListBookmarkController
 */
class ListBookmarkController extends AbstractController
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $response = $this->ask(new ListQuery());

        return new JsonResponse(json_encode($response), Response::HTTP_OK);
    }
}
