<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Command;

/**
 * Interface CommandBus.
 */
interface CommandBus
{
    /**
     * @param Command $command
     *
     * @return void
     */
    public function dispatch(Command $command): void;
}
