<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Model;

/**
 * Interface ViewModel.
 */
interface ViewModel
{
    /**
     * object $object
     *
     * @return static
     */
    public static function create(object $object): self;
}
