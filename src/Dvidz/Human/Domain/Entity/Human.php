<?php

declare(strict_types=1);

namespace Dvidz\Human\Domain\Entity;

/**
 * Class Human.
 */
class Human
{
    /**
     * @param string $type
     */
    private function __construct(protected string $type)
    {
    }

    /**
     * @param string $type
     *
     * @return Human
     */
    public static function createHuman(string $type)
    {
        return new self($type);
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }
}
