<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Specification;

use Dvidz\Bookmark\Domain\Entity\ValueType\Url;
use Dvidz\Bookmark\Domain\Exception\UrlException;
use Dvidz\Shared\Domain\Specification\Specification;

/**
 * Interface UrlSpecification.
 */
interface UrlSpecification extends Specification
{
    /**
     * @param Url $url
     *
     * @return bool
     *
     * @throws UrlException
     */
    public function isValidUrl(Url $url): bool;
}
