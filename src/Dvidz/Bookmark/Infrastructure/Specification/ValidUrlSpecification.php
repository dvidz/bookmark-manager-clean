<?php

declare(strict_types=1);

namespace Dvidz\Bookmark\Infrastructure\Specification;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Dvidz\Bookmark\Domain\Entity\ValueType\Url;
use Dvidz\Bookmark\Domain\Exception\UrlException;
use Dvidz\Bookmark\Domain\Specification\UrlSpecification;

/**
 * Class ValidUrlSpecification.
 */
class ValidUrlSpecification implements UrlSpecification
{
    /**
     * @param string $value
     *
     * @return bool
     *
     * @throws UrlException
     */
    public function isSatisfiedBy(string $value): bool
    {
        try {
            Assertion::url($value);
        } catch (AssertionFailedException $e) {
            throw new UrlException('Url is not valid');
        }

        return true;
    }

    /**
     * @param Url $url
     *
     * @return bool
     *
     * @throws UrlException
     */
    public function isValidUrl(Url $url): bool
    {
        return $this->isSatisfiedBy((string) $url);
    }
}
