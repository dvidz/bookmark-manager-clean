<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Model;

use Dvidz\Shared\Domain\Response\Response;

/**
 * Interface ViewModel.
 */
interface ViewModel
{
    /**
     * @param Response $response
     *
     * @return static
     */
    public static function createFromResponse(Response $response): self;
}
