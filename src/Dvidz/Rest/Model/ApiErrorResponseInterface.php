<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Model;

/**
 * Class ApiErrorResponseInterface.
 */
interface ApiErrorResponseInterface
{
    /**
     * @param array $errorData
     * @param int   $httpStatus
     *
     * @return ApiResponseInterface
     */
    public static function createErrorResponse(array $errorData, int $httpStatus): ApiResponseInterface;
}
