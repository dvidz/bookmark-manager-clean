<?php

declare(strict_types=1);

namespace App\Symfony\Rest\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 *
 * Class MediaSize.
 */
abstract class AbstractMediaSize implements MediaSizeInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     */
    protected float $width;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     */
    protected float $height;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @param float $width
     *
     * @return AbstractMediaSize
     */
    public function setWidth(float $width): AbstractMediaSize
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     *
     * @return AbstractMediaSize
     */
    public function setHeight(float $height): AbstractMediaSize
    {
        $this->height = $height;

        return $this;
    }
}
