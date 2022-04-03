<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Model;

/**
 * Interface ApiResponseInterface
 */
interface ApiResponseInterface
{
    /**
     * @param ViewModelInterface $viewModel
     * @param int                $httpStatus
     *
     * @return ApiResponseInterface
     */
    public static function createResponse(ViewModelInterface $viewModel, int $httpStatus): ApiResponseInterface;
}
