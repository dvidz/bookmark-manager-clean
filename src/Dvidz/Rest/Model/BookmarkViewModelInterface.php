<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Model;

use App\Dvidz\Rest\Entity\BookmarkInterface;

/**
 * Interface BookmarkViewModelInterface.
 */
interface BookmarkViewModelInterface
{
    public static function getViewModel(BookmarkInterface $bookmark): self;
}
