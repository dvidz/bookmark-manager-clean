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
     * @param Response $reponse
     *
     * @return $this
     */
    public static function createFromResponse(Response $reponse): self;

    /**
     * @return array
     */
    public function list(): array;
}
