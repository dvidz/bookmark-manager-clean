<?php

namespace Dvidz\Shared\Infrastructure;

use Dvidz\Shared\Domain\Entity\ValueObject\UuidInterface as DomainUuidInterface;
use Ramsey\Uuid\Uuid as RamseyUuid;

/**
 * Class Uuid.
 */
class Uuid implements DomainUuidInterface, \Stringable
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * Uuid class constructor.
     */
    public function __construct()
    {
        $this->value = RamseyUuid::uuid4()->toString();
    }

    /**
     * @return $this
     */
    public static function generate(): string
    {
        return new self();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
