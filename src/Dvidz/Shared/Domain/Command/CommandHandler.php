<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Command;

/**
 * Interface CommandHandler.
 */
interface CommandHandler
{
    public function __invoke(Command $command): void;
}
