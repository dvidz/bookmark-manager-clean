<?php

namespace Api\Bookmark\Bus\Query;

use Dvidz\Shared\Domain\Bus\Query\Query;
use Dvidz\Shared\Domain\Bus\Query\QueryBus;
use Dvidz\Shared\Domain\Bus\Response\Response;

class ListQueryBus implements QueryBus
{

    public function ask(Query $query): ?Response
    {
        // TODO: Implement ask() method.
    }
}