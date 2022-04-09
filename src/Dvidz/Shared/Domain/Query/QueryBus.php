<?php

declare(strict_types=1);

namespace Dvidz\Shared\Domain\Query;

use Dvidz\Shared\Domain\Response\Response;

/**
 * Interface QueryBus.
 */
interface QueryBus
{
    /**
     * @param Query $query
     *
     * @return Response|null
     */
    public function ask(Query $query): ?Response;
}
