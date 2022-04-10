<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Model;

use Dvidz\Shared\Domain\Response\Response;

/**
 * Interface ViewModel.
 */
interface ListViewModel
{
    /**
     * @return array
     */
    public function list(): array;
}
