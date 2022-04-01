<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class VideoSize.
 *
 * @ORM\Entity
 */
class VideoSize extends MediaSize implements VideoSizeInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="float", nullable=false)
     */
    protected string $duration;

    /**
     * @return string
     */
    public function getDuration(): string
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     *
     * @return VideoSize
     */
    public function setDuration(string $duration): VideoSize
    {
        $this->duration = $duration;

        return $this;
    }
}
