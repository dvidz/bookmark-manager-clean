<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\ValueObject;

/**
 * Interface VideoSizeInterface
 */
interface VideoSizeInterface
{
    /**
     * @return int|null
     */
    public function duration(): ?int;
}
