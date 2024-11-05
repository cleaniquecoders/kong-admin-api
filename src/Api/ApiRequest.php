<?php

namespace CleaniqueCoders\KongAdminApi\Api;

use CleaniqueCoders\KongAdminApi\Contracts\Request as RequestContract;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Class ApiRequest
 *
 * Represents a generic API request that can be customized with HTTP methods,
 * endpoints, and JSON body handling.
 */
class ApiRequest extends Request implements HasBody, RequestContract
{
    use HasJsonBody;

    /**
     * The endpoint for the API request.
     */
    protected string $endpoint = '';

    /**
     * The identifier for the API request.
     */
    protected string $identifier = '';

    /**
     * The data for the API request.
     *
     * @var array<string, mixed>
     */
    protected array $data = [];

    /**
     * Sets the HTTP method for the request.
     *
     * @param  Method  $method  The HTTP method to be used for the request (GET, POST, etc.)
     * @return $this
     */
    public function setMethod(Method $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Sets the endpoint for the API request.
     *
     * @param  string  $endpoint  The specific endpoint for the API request
     * @return $this
     */
    public function setEndPoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Gets the endpoint for the API request.
     *
     * @return string The endpoint for the API request
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Sets the identifier for the API request.
     *
     * @param  string  $identifier  The specific identifier for the API request
     * @return $this
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Gets the identifier for the API request.
     *
     * @return string The identifier for the API request
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Set the data for the API request.
     *
     * @param  array<string, mixed>  $data  Set the data for the API request
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->body()->set($data);

        return $this;
    }

    /**
     * Prepares a store request with POST method and data.
     *
     * @param  array<string, mixed>  $data  The data to store
     * @return $this
     */
    public function store(array $data): self
    {
        return $this
            ->setMethod(Method::POST)
            ->setData($data);
    }

    /**
     * Prepares an update request with PUT method, identifier, and data.
     *
     * @param  string  $identifier  The identifier for the resource to update
     * @param  array<string, mixed>  $data  The data for the update
     * @return $this
     */
    public function update(string $identifier, array $data): self
    {
        return $this
            ->setMethod(Method::PUT)
            ->setIdentifier($identifier)
            ->setData($data);
    }

    /**
     * Prepares a delete request with DELETE method and identifier.
     *
     * @param  string  $identifier  The identifier for the resource to delete
     * @return $this
     */
    public function delete(string $identifier): self
    {
        return $this
            ->setMethod(Method::DELETE)
            ->setIdentifier($identifier);
    }

    /**
     * Prepares a get request with GET method and optional identifier.
     *
     * @param  string|null  $identifier  The identifier for the resource to retrieve
     * @return $this
     */
    public function get(?string $identifier = null): self
    {
        $this->setMethod(Method::GET);

        if ($identifier !== null) {
            $this->setIdentifier($identifier);
        }

        return $this;
    }

    /**
     * Resolves the endpoint for the request.
     *
     * @return string The fully resolved endpoint for the API request
     */
    public function resolveEndpoint(): string
    {
        return $this->getEndpoint().($this->getIdentifier() !== '' ? '/'.$this->getIdentifier() : '');
    }
}
