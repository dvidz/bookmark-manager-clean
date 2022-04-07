<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Domain\ValueObject;

use Dvidz\Shared\Domain\ValueObject\MediaSize;

/**
 * Class ImageSize.
 */
class ImageSize extends MediaSize
{
    /**
     * @return int|null
     */
    public function duration(): ?int
    {
        return null;
    }
}
