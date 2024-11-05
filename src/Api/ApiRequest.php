<?php

namespace CleaniqueCoders\KongAdminApi\Api;

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
class ApiRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The endpoint for the API request.
     */
    private string $endpoint;

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
     * @param  string  $endpoint  The specific endpoint for the API resource
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
     * Resolves the endpoint for the request.
     *
     * @return string The fully resolved endpoint for the API request
     */
    public function resolveEndpoint(): string
    {
        return $this->getEndpoint();
    }
}
