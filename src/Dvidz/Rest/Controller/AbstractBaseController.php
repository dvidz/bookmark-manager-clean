<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Controller;

use App\Dvidz\Rest\Model\ApiResponseInterface;
use App\Dvidz\Rest\Model\BookmarkViewModelInterface;
use App\Dvidz\Rest\Model\JsonApiResponse;
use App\Dvidz\Rest\Model\ViewModelInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AbstractBaseController.
 */
abstract class AbstractBaseController extends AbstractController
{
    /**
     * @param ViewModelInterface $viewModel
     * @param int                $httpStatus
     *
     * @return ApiResponseInterface
     */
    public function createResponse(ViewModelInterface $viewModel, int $httpStatus): ApiResponseInterface
    {
        return JsonApiResponse::createResponse($viewModel, $httpStatus);
    }

    /**
     * @param BookmarkViewModelInterface[] $bookmarks
     * @param int                          $httpStatus
     *
     * @return ApiResponseInterface
     */
    public function createListResponse(array $bookmarks, int $httpStatus): ApiResponseInterface
    {
        return JsonApiResponse::createListResponse($bookmarks, $httpStatus);
    }

    /**
     * @param array $data
     * @param int   $httpStatus
     *
     * @return ApiResponseInterface
     */
    public function createErrorResponse(array $data, int $httpStatus): ApiResponseInterface
    {
        return JsonApiResponse::createErrorResponse($data, $httpStatus);
    }

    /**
     * @param int $httpStatus
     *
     * @return ApiResponseInterface
     */
    public function createEmptyResponse(int $httpStatus): ApiResponseInterface
    {
        return JsonApiResponse::createErrorResponse([], $httpStatus);
    }
}
