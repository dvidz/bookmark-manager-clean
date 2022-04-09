<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Entity;

use Dvidz\Shared\Domain\Entity\ValueObject\UuidInterface;

/**
 * Abstract class AggregateRoot.
 */
abstract class AggregateRoot
{
    /**
     * @var string
     */
    protected string $uuid;

    /**
     * @param UuidInterface $uuid
     */
    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid::generate();
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid;
    }
}
