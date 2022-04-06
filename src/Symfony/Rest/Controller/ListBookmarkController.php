<?php

namespace App\Symfony\Rest\Controller;

use App\Symfony\Rest\Exception\MediaTypeException;
use App\Symfony\Rest\Exception\NullTypeLinkException;
use App\Symfony\Rest\Model\BookmarkViewModel;
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
