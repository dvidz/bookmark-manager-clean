<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class BookmarkContext implements Context
{
    /** @var KernelInterface */
    private $kernel;

    /** @var Response|null */
    private $response;

    /** @var string|null */
    private $endpoint;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given the endpoint url :endpoint
     */
    public function setEndpointUrl(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @When it sends a post request with valid link :url
     */
    public function postBookmark(string $url)
    {
        $this->response = $this->kernel->handle(Request::create($this->endpoint, 'POST', ['url' => $url]));
    }

    /**
     * @Then the http response code should :responseCode
     */
    public function theResponseStatusCodeShouldBeCreated(int $responseCode): void
    {
        if ($this->response->getStatusCode() !== $responseCode) {
            throw new \RuntimeException('Invalid status code');
        }
    }

    /**
     * @When it sends a get request
     */
    public function listBookmark()
    {
        $this->response = $this->kernel->handle(Request::create($this->endpoint, 'GET'));
    }

    /**
     * @When it sends a delete request with id :id
     */
    public function deleteBookmark(string $id)
    {
        $this->response = $this->kernel->handle(Request::create($this->endpoint.$id, 'DELETE'));
    }
}