<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Model;

use App\Symfony\Rest\Entity\BookmarkInterface;

/**
 * Interface BookmarkViewModelInterface.
 */
interface BookmarkViewModelInterface extends ViewModelInterface
{
    /**
     * @param BookmarkInterface $bookmark
     *
     * @return BookmarkViewModelInterface
     */
    public static function getViewModel(BookmarkInterface $bookmark): BookmarkViewModelInterface;
}
