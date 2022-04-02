<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Controller;

use App\Dvidz\Rest\Manager\BookmarkManager;
use App\Dvidz\Rest\Repository\BookmarkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookmarkController.
 *
 * @Route(path="/api")
 */
class BookmarkController extends AbstractController
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
     * @Route("/bookmark", name="bookmark_list", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function bookmark(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_OK);
    }
}
