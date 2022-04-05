<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Entity;

/**
 * Interface VideoSizeInterface.
 */
interface VideoSizeInterface extends MediaSizeInterface
{
    /**
     * @param string|null $duration
     *
     * @return $this
     */
    public function setDuration(?string $duration): self;

    /**
     * @return string|null
     */
    public function getDuration(): ?string;
}
