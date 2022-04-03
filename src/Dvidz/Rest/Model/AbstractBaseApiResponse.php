<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Model;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class BaseApiResponse.
 */
abstract class AbstractBaseApiResponse extends Response
{
    /**
     * @var Serializer
     */
    protected Serializer $serializer;

    /**
     * @param string|null $content
     * @param int         $status
     * @param array       $headers
     */
    public function __construct(?string $content = '', int $status = 200, array $headers = [])
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);

        parent::__construct($content, $status, $headers);
    }
}
