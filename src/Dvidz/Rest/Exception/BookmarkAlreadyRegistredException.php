<?php

declare(strict_types=1);

namespace App\Dvidz\Rest\Exception;

/**
 * Class BookmarkAlreadyRegistredException.
 */
class BookmarkAlreadyRegistredException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = "This url is already registered")
    {
        parent::__construct($message);
    }
}
