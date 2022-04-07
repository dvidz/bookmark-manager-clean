<?php

namespace Dvidz\Bookmark\Infrastructure\Entity;

use Dvidz\Shared\Domain\ValueObject\MediaSize as DomainMediaSize;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class MediaSize extends DomainMediaSize
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=30, nullable=false)
     */
    protected int $width;

    /**
     * @ORM\Column(type="integer", length=30, nullable=false)
     */
    protected int $height;

    /**
     * @ORM\Column(type="integer", length=30, nullable=true)
     */
    protected int $duration;
}
