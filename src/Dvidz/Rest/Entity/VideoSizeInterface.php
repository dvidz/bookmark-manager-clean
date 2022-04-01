<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

/**
 * Interface VideoSizeInterface.
 */
interface VideoSizeInterface extends MediaSizeInterface
{
    /**
     * @param string $duration
     *
     * @return VideoSizeInterface
     */
    public function setDuration(string $duration): self;

    /**
     * @return string
     */
    public function getDuration(): string;
}
