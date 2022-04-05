<?php

namespace App\Dvidz\Rest\Controller;

use App\Dvidz\Rest\Entity\Bookmark;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RemoveBookmarkController.
 */
class RemoveBookmarkController extends AbstractBaseController
{
    /**
     * @param Bookmark $bookmark
     *
     * @return JsonResponse
     */
    public function __invoke(Bookmark $bookmark): JsonResponse
    {
        try {
            $this->bookmarkService->getRepository()->removeBookmark($bookmark);
        } catch (\Exception $e) {
            return new JsonResponse([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
