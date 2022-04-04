<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Controller;

use App\Dvidz\Rest\Entity\Bookmark;
use App\Dvidz\Rest\Exception\MalformedUrlException;
use App\Dvidz\Rest\Exception\MediaTypeException;
use App\Dvidz\Rest\Exception\NullTypeLinkException;
use App\Dvidz\Rest\Model\BookmarkViewModel;
use App\Dvidz\Rest\Service\BookmarkService;
use App\Dvidz\Rest\Service\BookmarkServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookmarkController.
 *
 * @Route(path="/api")
 */
class BookmarkController extends AbstractBaseController
{
    /**
     * @Route("/bookmark", name="api_bookmark_list", methods={"GET"})
     *
     * @param BookmarkServiceInterface $bookmarkService
     *
     * @return JsonResponse
     */
    public function bookmark(BookmarkServiceInterface $bookmarkService): JsonResponse
    {
        $bookmarkList = [];

        try {
            $bookmarks = $bookmarkService->getRepository()->findAll();

            foreach ($bookmarks as $bookmark) {
                $bookmarkList[] = BookmarkViewModel::getViewModel($bookmark);
            }

            return new JsonResponse($bookmarkList, Response::HTTP_OK);
        } catch (MediaTypeException|NullTypeLinkException $e) {
            return new JsonResponse([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/bookmark", name="api_bookmark_create", methods={"POST"})
     *
     * @param Request         $request
     * @param BookmarkService $bookmarkService
     *
     * @return JsonResponse
     */
    public function createBookmark(Request $request, BookmarkService $bookmarkService): JsonResponse
    {
        if (null === $request->request->get('url')) {
            return new JsonResponse(['url parameters is mandatory'], Response::HTTP_BAD_REQUEST);
        }

        $linkToBookmark = (string) $request->request->get('url');

        try {
            $bookmark = $bookmarkService->bookmark($linkToBookmark);

            return new JsonResponse(BookmarkViewModel::getViewModel($bookmark), Response::HTTP_CREATED);
        } catch (MalformedUrlException|MediaTypeException|\Exception $e) {
            return new JsonResponse([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/bookmark/{id}", name="api_bookmark_delete", methods={"DELETE"})
     *
     * @param Bookmark                 $bookmark
     * @param BookmarkServiceInterface $bookmarkService
     *
     * @return JsonResponse
     */
    public function deleteBookmark(Bookmark $bookmark, BookmarkServiceInterface $bookmarkService): JsonResponse
    {
        try {
            $bookmarkService->getRepository()->removeBookmark($bookmark);
        } catch (\Exception $e) {
            return new JsonResponse([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
