<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\Specification;

use Dvidz\Bookmark\Domain\Entity\ValueType\Url;
use Dvidz\Bookmark\Domain\Exception\UrlAlreadyBookmarkedException;
use Dvidz\Shared\Domain\Specification\Specification;

/**
 * Interface UniqueUrlSpecification.
 */
interface UniqueUrlSpecification extends Specification
{
    /**
     * @param Url $url
     *
     * @return bool
     *
     * @throws UrlAlreadyBookmarkedException
     */
    public function isUniqueUrl(Url $url): bool;
}
