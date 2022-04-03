<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use App\Dvidz\Rest\Repository\BookmarkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookmarkRepository::class)
 */
class Bookmark extends AbstractBookmark
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $id;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->id = $url;
    }
}
