<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\ValueObject;

/**
 * Abstract class StringableValueObject
 */
abstract class StringableValueObject implements \Stringable
{
    /**
     * @param string $value
     */
    public function __construct(protected string $value)
    {
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
