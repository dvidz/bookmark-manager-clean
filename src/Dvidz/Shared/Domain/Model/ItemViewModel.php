<?php

namespace Dvidz\Shared\Domain\Model;

use Dvidz\Shared\Domain\Entity\AggregateRoot;

/**
 * Interface ItemViewModel
 */
interface ItemViewModel
{
    /**
     * @param AggregateRoot $aggregateRoot
     *
     * @return static
     */
    public static function createFromAggregate(AggregateRoot $aggregateRoot): self;
}
