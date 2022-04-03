<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Controller;

use App\Dvidz\Rest\Exception\MediaTypeException;
use App\Dvidz\Rest\Manager\BookmarkManager;
use App\Dvidz\Rest\Model\ApiResponseInterface;
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
     * @var BookmarkManager
     */
    protected BookmarkManager $bookmarkManager;

    /**
     * @param BookmarkManager $bookmarkManager
     */
    public function __construct(BookmarkManager $bookmarkManager)
    {
        $this->bookmarkManager = $bookmarkManager;
    }

    /**
     * @Route("/bookmark", name="api_bookmark_list", methods={"GET"})
     *
     * @param Request $request
     *
     * @return ApiResponseInterface
     */
    public function bookmark(Request $request): ApiResponseInterface
    {
        //return $this->createErrorResponse([], Response::HTTP_NOT_IMPLEMENTED);
        $linkToBookmark = $request->query->get('url');
        $bookmark = $this->bookmarkManager->bookmark((string) $linkToBookmark);

        try {
            $bookmarkViewModel = $this->bookmarkManager->getViewModel($bookmark);
            $response = $this->createResponse($bookmarkViewModel, Response::HTTP_CREATED);
        } catch (MediaTypeException $e) {
            $response = $this->createErrorResponse([$e->getMessage()], Response::HTTP_NOT_IMPLEMENTED);
        }

        return $response;
    }

    /**
     * @Route("/bookmark", name="api_bookmark_create", methods={"POST"})
     *
     * @param Request $request
     *
     * @return ApiResponseInterface
     */
    public function createBookmark(Request $request): ApiResponseInterface
    {
        $linkToBookmark = (string) $request->request->get('url');
        $bookmark = $this->bookmarkManager->bookmark($linkToBookmark);

        try {
            $bookmarkViewModel = $this->bookmarkManager->getViewModel($bookmark);
            $response = $this->createResponse($bookmarkViewModel, Response::HTTP_CREATED);
        } catch (MediaTypeException $e) {
            $response = $this->createErrorResponse([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}
