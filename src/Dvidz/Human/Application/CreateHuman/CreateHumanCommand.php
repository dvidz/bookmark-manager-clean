<?php

declare(strict_types=1);

namespace Dvidz\Human\Application\CreateHuman;

use Dvidz\Shared\Domain\Command\Command;

/**
 * Class CreateHumanCommand.
 */
class CreateHumanCommand implements Command
{
    /**
     * @param string $type
     */
    public function __construct(protected string $type)
    {
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }
}
