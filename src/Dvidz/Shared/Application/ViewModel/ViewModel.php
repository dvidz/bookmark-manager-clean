<?php

declare(strict_types=1);

namespace Dvidz\Shared\Application\ViewModel;

use Dvidz\Shared\Domain\AggregateRoot;

/**
 * Interface ViewModel.
 */
interface ViewModel
{
    /**
     * @param AggregateRoot|array $aggregateRoot
     *
     * @return $this
     */
    public function create(AggregateRoot|array $aggregateRoot): self;

    /**
     * @return mixed
     */
    public function getView(): mixed;
}
