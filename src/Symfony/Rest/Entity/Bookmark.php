<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Entity;

use App\Symfony\Rest\Repository\BookmarkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookmarkRepository::class)
 */
class Bookmark extends AbstractBookmark
{
}
