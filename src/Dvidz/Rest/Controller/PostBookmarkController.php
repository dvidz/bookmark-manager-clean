<?php

namespace App\Dvidz\Rest\Controller;

use App\Dvidz\Rest\Exception\MediaTypeException;
use App\Dvidz\Rest\Model\BookmarkViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostBookmarkController.
 */
class PostBookmarkController extends AbstractBaseController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        if (null === $linkToBookmark = $request->request->get('url')) {
            return new JsonResponse(['url parameters is mandatory'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $bookmark = $this->bookmarkService->bookmark(strval($linkToBookmark));

            return new JsonResponse(BookmarkViewModel::getViewModel($bookmark), Response::HTTP_CREATED);
        } catch (MediaTypeException|\Exception $e) {
            return new JsonResponse([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
