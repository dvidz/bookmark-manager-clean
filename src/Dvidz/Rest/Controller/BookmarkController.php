<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Controller;

use App\Dvidz\Rest\Exception\MediaTypeException;
use App\Dvidz\Rest\Manager\BookmarkManager;
use App\Dvidz\Rest\Model\ApiResponseInterface;
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
        return $this->createErrorResponse([], Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * @Route("/bookmark", name="api_bookmark_create", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function createBookmark(Request $request): Response
    {
        $linkToBookmark = $request->request->get('url');
        $bookmark = $this->bookmarkManager->bookmark($linkToBookmark);

        try {
            $bookmarkViewModel = $this->bookmarkManager->getViewModel($bookmark);
        } catch (MediaTypeException $e) {
            return new Response(json_encode([$e->getMessage()]), Response::HTTP_NOT_IMPLEMENTED);
        }

        return new Response(json_encode($bookmarkViewModel), Response::HTTP_CREATED);
    }
}
