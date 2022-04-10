<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Specification;

/**
 * Interface Specification.
 */
interface Specification
{
    /**
     * @param string $value
     *
     * @return bool
     */
    public function isSatisfiedBy(string $value): bool;
}
