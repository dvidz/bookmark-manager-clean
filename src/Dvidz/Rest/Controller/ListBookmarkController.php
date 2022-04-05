<?php

namespace App\Dvidz\Rest\Controller;

use App\Dvidz\Rest\Exception\MediaTypeException;
use App\Dvidz\Rest\Exception\NullTypeLinkException;
use App\Dvidz\Rest\Model\BookmarkViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListBookmarkController
 */
class ListBookmarkController extends AbstractBaseController
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $bookmarkList = [];

        try {
            $bookmarks = $this->bookmarkService->getRepository()->findAll();

            foreach ($bookmarks as $bookmark) {
                $bookmarkList[] = BookmarkViewModel::getViewModel($bookmark);
            }

            return new JsonResponse($bookmarkList, Response::HTTP_OK);
        } catch (MediaTypeException|NullTypeLinkException $e) {
            return new JsonResponse([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
