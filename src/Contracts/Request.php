<?php

namespace CleaniqueCoders\KongAdminApi\Contracts;

use CleaniqueCoders\KongAdminApi\Enums\Endpoint;
use Saloon\Enums\Method;

/**
 * Interface Request
 *
 * Defines the contract for API request objects, outlining the methods required
 * to configure and retrieve details about an API request, such as the HTTP method
 * and endpoint.
 */
interface Request
{
    /**
     * Set the HTTP method for the request.
     *
     * @param  Method  $method  The HTTP method (e.g., GET, POST, PATCH, DELETE)
     */
    public function setMethod(Method $method): self;

    /**
     * Get the HTTP method for the request.
     *
     * @return Method The HTTP method
     */
    public function getMethod(): Method;

    /**
     * Set the endpoint for the API request.
     *
     * @param  Endpoint  $endpoint  The API endpoint
     */
    public function setEndpoint(Endpoint $endpoint): self;

    /**
     * Get the endpoint for the API request.
     *
     * @return Endpoint The endpoint for the API request
     */
    public function getEndpoint(): Endpoint;

    /**
     * Resolve and retrieve the complete endpoint path for the API request.
     *
     * @return string The resolved endpoint path
     */
    public function resolveEndpoint(): string;
}
