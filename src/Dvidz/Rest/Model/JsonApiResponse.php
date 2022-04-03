<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Model;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class ApiResponse.
 */
class JsonApiResponse extends BaseApiResponse implements ApiResponseInterface, ApiErrorResponseInterface
{
    /**
     * @param ViewModelInterface $viewModel
     * @param int                $httpStatus
     *
     * @return ApiResponseInterface
     */
    public static function createResponse(ViewModelInterface $viewModel, int $httpStatus): ApiResponseInterface
    {
        $jsonApiResponse = new self();
        $jsonApiResponse->headers = new ResponseHeaderBag(
            [
                'Content-Type' => 'application/json; charset=utf-8'
            ]
        );

        $jsonApiResponse->setContent($jsonApiResponse->serializer->serialize($viewModel, 'json'));
        $jsonApiResponse->setStatusCode($httpStatus);
        $jsonApiResponse->setProtocolVersion('1.0');

        return $jsonApiResponse;
    }

    /**
     * @param array $errorData
     * @param int   $httpStatus
     *
     * @return ApiResponseInterface
     */
    public static function createErrorResponse(array $errorData, int $httpStatus): ApiResponseInterface
    {
        $jsonApiResponse = new self();
        $jsonApiResponse->headers = new ResponseHeaderBag(
            [
                'Content-Type' => 'application/json; charset=utf-8'
            ]
        );

        $jsonApiResponse->setContent($jsonApiResponse->serializer->serialize($errorData, 'json'));
        $jsonApiResponse->setStatusCode($httpStatus);
        $jsonApiResponse->setProtocolVersion('1.0');

        return $jsonApiResponse;
    }
}
