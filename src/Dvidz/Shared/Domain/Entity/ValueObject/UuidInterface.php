<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Entity\ValueObject;

/**
 * Interface UuidInterface.
 */
interface UuidInterface
{
    /**
     * @return string
     */
    public static function generate(): string;
}
